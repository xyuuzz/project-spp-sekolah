<?php

use App\Http\Livewire\{Admin, DataSekolah};
use App\Http\Controllers\APIBri;
use Illuminate\Support\Facades\Route;

Route::view("/", "welcome");

Route::prefix("admin")->group(function() {
//    Route::get('/', [AdminController::class, "index"])->name("admin.index");
    Route::get("/data-sekolah", DataSekolah::class)->name("admin.index-register-teacher-student");

    Route::get("/", Admin::class)->name("admin");
});

Route::get("register/{school_class:link}", Admin::class)->name("register");

Route::get("apibri", APIBri::class);
