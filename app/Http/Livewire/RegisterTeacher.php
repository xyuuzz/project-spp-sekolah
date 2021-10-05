<?php

namespace App\Http\Livewire;

use App\Models\LinkRegister;
use App\Models\User;
use Livewire\Component;
use function bcrypt;
use function uniqid;

class RegisterTeacher extends Component
{
    public LinkRegister $link_register;
    public $name, $phone_number, $email, $password, $gender;

    public function mount()
    {
        if(now() < $this->link_register->valid_from || now() > $this->link_register->valid_until)
        {
            abort(403, "Link Ditutup!");
            return;
        }
    }

    public function render()
    {
        return view('livewire.register-teacher')->layout("livewire.blank_page", ["title" => "Pendaftaran Guru Wali Kelas " . $this->link_register->class->class]);
    }

    public function register()
    {
        $data = $this->validate([
            "name" => "required|string",
            "phone_number" => "required|numeric|unique:phones,phone_number",
            "email" => "required|email|unique:users,email",
            "password" => "required|string|min:6",
            "gender" => "required|string|in:Laki-Laki,Perempuan"
        ], [
            "name.required" => "Kolom Nama Wajib Anda Isi!",
            "name.string" => "Kolom Nama Wajib bertipe text",
            "phone_number.required" => "Kolom Nomor HP Wajib Anda diisi",
            "phone_number.numeric" => "Kolom Nomor HP Wajib bertipe number / angka",
            "phone_number.unique" => "Nomor HP yang anda masukan sudah digunakan orang lain!",
            "email.required" => "Wajib mengisi kolom email!",
            "email.email" => "Format tulisan tidak berbentuk email!",
            "email.unique" => "Email yang anda masukan sudah digunakan orang lain!",
            "password.required" => "Kolom Password wajib diisi!",
            "password.string" => "Kolom Password harus berbentuk string/kata!",
            "password.min" => "Minimal 6 huruf!",
            "gender.required" => "Wajib memilih jenis kelamin!",
            "gender.string" => "Pilihan jenis kelamin wajib berbentuk string!",
            "gender.in" => "Hanya ada 2 pilihan 2 jenis kelamin! Laki - Laki atau Perempuan",
        ]);

        try {
//        store data
            $data["role"] = "teacher";
            $data["slug"] = uniqid() . $data["name"];
            $data["password"] = bcrypt($this->password);
            $user = User::create($data);
//        phone number
            $user->phone()->create(["phone_number" => $data["phone_number"]]);
//        class
            $user->class_teacher()->create(["class_id" => $this->link_register->class->id]);

            return redirect(route("teacher"));
        } catch(\Exception $err) {
            abort(403, "Terjadi Error Saat Memasukan Data! Mohon Daftar Kembali");
        }
    }
}
