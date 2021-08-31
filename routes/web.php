<?php

use App\Http\Livewire\{Admin, DataSekolah, Login, RegisterStudent, Student};
use App\Http\Controllers\APIBri;
use Illuminate\Support\Facades\{Auth, Route};

Route::middleware("guest")->group(function() {
    Route::get("login", Login::class)->name("login");
    Route::get("register/student/{link_register:link}", RegisterStudent::class)->name("register_student");
});

Route::middleware(["auth"])->group(function() {

    Route::prefix("admin")->group(function() {
        Route::get("/", Admin::class)->name("admin");

        Route::get("/data-sekolah", DataSekolah::class)
             ->name("admin.index-register-teacher-student");
    });

    Route::get("/", Student::class)->name("student");

    Route::get("logout", function() {
        Auth::logout();
        return redirect("login");
    })->name("logout");

});

Route::get("apibri", APIBri::class);
