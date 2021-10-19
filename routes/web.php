<?php

use App\Http\Livewire\{Admin,
    BayarSpp,
    DataSekolah,
    HomeProfile,
    Login,
    RegisterStudent,
    RegisterTeacher,
    StudentIndex,
    TeacherIndex,
    TeacherReportIndex};
use App\Http\Controllers\APIBri;
use Illuminate\Support\Facades\{Auth, Route};

Route::middleware("guest")->group(function() {
    Route::get("login", Login::class)->name("login");
    Route::get("pendaftaran/siswa/{link_register:link}", RegisterStudent::class)->name("register_student");
    Route::get("pendaftaran/guru/{link_register:link}", RegisterTeacher::class)->name("register_teacher");
});

Route::middleware(["auth"])->group(function() {

    Route::middleware("admin")->prefix("admin")->group(function() {
        Route::get("/", Admin::class)->name("admin");
        Route::get("/data-sekolah", DataSekolah::class)
             ->name("admin.index-register-teacher-student");
    });

    Route::middleware("student")->group(function() {
        Route::get("/", StudentIndex::class)->name("student");
        Route::get("profile", HomeProfile::class)->name("student_profile");
    });

    Route::prefix("guru")->middleware("teacher")->group(function() {
        Route::get("/", TeacherIndex::class)->name("teacher");
        Route::get("laporan", TeacherReportIndex::class)->name("teacher_report");
    });

    Route::get("logout", function() {
        Auth::logout();
        return redirect("login");
    })->name("logout");
});

Route::get("apibri", APIBri::class);
Route::get("pdf", [BayarSpp::class, "cetak_struk"])->name("getpdf");
