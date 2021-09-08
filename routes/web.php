<?php

use App\Http\Livewire\{Admin,
    DataSekolah,
    Login,
    Profile,
    RegisterStudent,
    Student
};
use App\Http\Controllers\APIBri;
use Illuminate\Support\Facades\{Auth, Route};

Route::middleware("guest")->group(function() {
    Route::get("login", Login::class)->name("login");
    Route::get("register/student/{link_register:link}", RegisterStudent::class)->name("register_student");
});

Route::middleware(["auth"])->group(function() {

    Route::middleware("admin")->prefix("admin")->group(function() {
        Route::get("/", Admin::class)->name("admin");

        Route::get("/data-sekolah", DataSekolah::class)
             ->name("admin.index-register-teacher-student");
    });

    Route::middleware("student")->group(function() {
        Route::get("/", Student::class)->name("student");
        Route::get("profile", Profile::class)->name("student_profile");
    });

    Route::get("logout", function() {
        Auth::logout();
        return redirect("login");
    })->name("logout");
});

Route::get("apibri", APIBri::class);
