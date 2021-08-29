<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $title = "Admin Website Pembayaran SPP Siswa";
        return view("admin.index", compact("title"));
    }

    public function index_register_student_teacher()
    {
        $title = "Daftar Link Pendaftaran Siswa & Guru";
        return view("admin.index-register-student-teacher", compact("title"));
    }
}
