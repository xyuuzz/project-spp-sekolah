<?php

use App\Http\Livewire\{Admin, DataSekolah, Login};
use App\Http\Controllers\APIBri;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Route::view("/", "welcome");

Route::middleware("guest")->get("login", Login::class)->name("login");

Route::middleware("auth")->group(function() {
    Route::get("/", Admin::class)->name("admin");

    Route::get("/data-sekolah", DataSekolah::class)->name("admin.index-register-teacher-student");

    Route::get("logout", function() {
        Auth::logout();
        return redirect("login");
    });

});

Route::get("register/{school_class:link}", Admin::class)->name("register");
Route::get("apibri", APIBri::class);
