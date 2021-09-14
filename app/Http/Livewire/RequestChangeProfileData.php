<?php

namespace App\Http\Livewire;

use App\Models\SchoolClass;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RequestChangeProfileData extends Component
{
    public $name, $password, $email, $class_id, $gender, $number_phone, $nisn, $nis, $view;

    public function mount()
    {
        $user = auth()->user()?->request_data_profile()?->first() ?? auth()->user();

        $this->name = $user->name;
        $this->email = $user->email;
        $this->gender = $user->gender;
        $this->class_id = $user?->profile?->class?->id ?? $user->class_id;
        $this->number_phone = $user?->profile?->number_phone ?? $user->number_phone;
        $this->nisn = $user?->profile?->nisn ?? $user->nisn;
        $this->nis = $user?->profile?->nis ?? $user->nis;

        $this->view = $user?->status === 0 ? "text" : "form";
    }

    public function render()
    {
        return view('livewire.request-change-profile-data');
    }

    public function submitForm()
    {
        $user = auth()->user();
        $data = $this->validate([
            "name" => "required|string|unique:users,name," . $user->id,
            "email" => "required|email|min:6|unique:users,email," . $user->id,
            "password" => "nullable|string|min:6",
            "class_id" => "required|in:" . implode("," , SchoolClass::get()->map(fn($class) => $class->id)->toArray()),
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
            "class_id.required" => "Wajib memilih minimal 1 kelas!",
            "class_id.in" => "Kelas yang anda pilih tidak terdaftar, Silahkan Pilih Kelas Kembali!",
            "gender.required" => "Wajib memilih salah satu jenis kelamin!",
            "gender.string" => "Pilihan jenis kelamin harus berbentuk string/kata",
            "gender.in" => "Jenis kelamin tersebut tidak resmi",
            "nis.required" => "Kolom NIS wajib diisi!",
            "nis.numeric" => "Kolom NIS hanya berisi angka & berbentuk numeric",
            "nis.unique" => "NIS tersebut sudah digunakan!",
            "nisn.required" => "Kolom NISN wajib diisi!",
            "nisn.numeric" => "Kolom NISN hanya berisi angka & berbentuk numeric",
            "nisn.unique" => "NISN tersebut sudah digunakan!",
            "number_phone.required" => "Kolom No. Handphone Wajib diisi!",
            "number_phone.numeric" => "Kolom No. Handphone hanya berisi angka saja",
            "number_phone.unique" => "No. Handphone tersebut sudah digunakan orang lain"
        ]);

        try
        {
            $comparison = collect($data);

//            jika data yang dimasukan sama persis dengan data yang ada di db, maka keluar dari method ini
            if($comparison->except("password")->toArray()
                == $user?->request_data_profile()
                  ?->first()->only("name", "gender", "email", "class_id", "nis", "nisn", "number_phone"))
            {
                $this->view = "text";
                session()->flash("failed", "Gagal mengajukan perubahan data, karena data yang dimasukan sama seperti data sebelumnya!");
                return;
            }

            $user->request_data_profile()->updateOrCreate(["user_id" => Auth::id()], $data);
            $this->view = "text";
            session()->flash("success", "Berhasil mengajukan perubahan data ke Wali Kelas");
        }
        catch(\Exception $e)
        {
            abort(403, "Server Error!");
        }
    }
}

//$comparison->only("name", "email", "gender")->toArray()
//=== User::find(auth()->id())->only("name", "email", "gender")
//&& $comparison->only("class_id", "nis", "nisn", "number_phone")->toArray()
//=== Profile::firstWhere("user_id", auth()->id())->only("class_id", "nis", "nisn", "number_phone")
