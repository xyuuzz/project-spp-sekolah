<?php

namespace App\Http\Livewire;

use App\Models\SchoolClass;
use Livewire\Component;
use function auth;
use function implode;

class RequestChangeProfileData extends Component
{
    public $name, $password, $email, $class, $gender, $number_phone, $nisn, $nis;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->class = $user->profile->class->id;
        $this->gender = $user->gender;
        $this->number_phone = $user->profile->number_phone;
        $this->nisn = $user->profile->nisn;
        $this->nis = $user->profile->nis;
    }

    public function render()
    {
        return view('livewire.request-change-profile-data');
    }

    public function submitForm()
    {
        $user = auth()->user();
        $this->validate([
            "name" => "required|string|unique:users,name," . $user->id,
            "email" => "required|email|min:6|unique:users,email," . $user->id,
            "password" => "nullable|string|min:6",
            "class" => "required|in:" . implode("," , SchoolClass::get()->map(fn($class) => $class->id)->toArray()),
            "gender" => "required|string|in:Laki-Laki,Perempuan",
            "nis" => "required|numeric|unique:profiles,nis," . $user->profile->id,
            "nisn" => "required|numeric|unique:profiles,nisn," . $user->profile->id,
            "number_phone" => "required|numeric|unique:profiles,number_phone," . $user->profile->id
        ], [
            "name.required" => "Kolom Nama Harus diisi!",
            "name.string" => "Kolom nama harus berbentuk string/kata",
            "name.unique" => "Nama tersebut sudah digunakan!",
            "email.required" => "Kolom email Harus diisi!",
            "email.email" => "Tulis dengan format email yang benar!",
            "email.unique" => "Email tersebut sudah digunakan!",
            "password.string" => "Kolom Password harus berbentuk string/kata",
            "password.min" => "Panjang minimal password adalah 6",
            "class.required" => "Wajib memilih minimal 1 kelas!",
            "class.in" => "Kelas yang anda pilih tidak terdaftar, Silahkan Pilih Kelas Kembali!",
            "gender.required" => "Wajib memilih salah satu jenis kelamin!",
            "gender.string" => "Pilihan jenis kelamin harus berbentuk string/kata",
            "gender.in" => "Jenis kelamin tersebut tidak resmi",
            "nis.required" => "Kolom NIS wajib diisi!",
            "nis.numeric" => "Kolom NIS hanya berisi angka & berbentuk numeric",
            "nis.unique" => "NIS tersebut sudah digunakan!",
            "nisn.required" => "Kolom NISN wajib diisi!",
            "nisn.numeric" => "Kolom NISN hanya berisi angka & berbentuk numeric",
            "nisn.unique" => "NISN tersebut sudah digunakan!",
        ]);

        dd("berhasil");
    }
}
