<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\{WithFileUploads, Component};
use App\Models\{SchoolClass, Profile};
use function array_keys;
use function arrayValue;
use function auth;
use function bcrypt;
use function dd;
use function explode;
use function uniqid;

class RequestChangeProfileData extends Component
{
    use WithFileUploads;

    public $name, $password, $email, $class_id, $gender, $phone_number, $nisn, $nis, $view, $no_absen, $photo_profile;

    public function mount()
    {
//        cari data pertama dari relasi request data profile, jika tidak ada ambil data user auth
        $user = auth()->user()?->request_data_profile()?->first() ?? auth()->user();

        $this->no_absen = $user?->profile?->no_absen ?? $user->no_absen;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->gender = $user->gender;
        $this->class_id = $user?->profile?->class?->class?->class_id ?? $user->class_id;
//
        $this->phone_number = $user?->profile?->phone->phone_number ?? $user->phone_number;
//
        $this->nisn = $user?->profile?->nisn ?? $user->nisn;
        $this->nis = $user?->profile?->nis ?? $user->nis;
        $this->password = "";

        $this->view = $user?->status === 0 ? "text" : "form";
    }

    public function render()
    {
        return view('livewire.request-change-profile-data');
    }

    public function submitForm()
    {
        $user = auth()->user();
        $data = $this->validate(Profile::rules_student($user, photo_profile: $this->photo_profile !== null, password: $this->password ?? true), Profile::messages_student());
//        $data = $this->validate([
//            "name" => "required|string|unique:users,name," . $user->id,
//            "email" => "required|email|min:6|unique:users,email," . $user->id,
//            "password" => "nullable|string|min:6",
//            "class_id" => "required|in:" . implode("," , SchoolClass::get()->map(fn($class) => $class->id)->toArray()),
//            "gender" => "required|string|in:Laki-Laki,Perempuan",
//            "nis" => "required|numeric|unique:profiles,nis," . $user->profile->id,
//            "nisn" => "required|numeric|unique:profiles,nisn," . $user->profile->id,
//            "phone_number" => "required|numeric|unique:profiles,phone_number," . $user->profile->id
//        ], [
//            "name.required" => "Kolom Nama Harus diisi!",
//            "name.string" => "Kolom nama harus berbentuk string/kata",
//            "name.unique" => "Nama tersebut sudah digunakan!",
//            "email.required" => "Kolom email Harus diisi!",
//            "email.email" => "Tulis dengan format email yang benar!",
//            "email.unique" => "Email tersebut sudah digunakan!",
//            "password.string" => "Kolom Password harus berbentuk string/kata",
//            "password.min" => "Panjang minimal password adalah 6",
//            "class_id.required" => "Wajib memilih minimal 1 kelas!",
//            "class_id.in" => "Kelas yang anda pilih tidak terdaftar, Silahkan Pilih Kelas Kembali!",
//            "gender.required" => "Wajib memilih salah satu jenis kelamin!",
//            "gender.string" => "Pilihan jenis kelamin harus berbentuk string/kata",
//            "gender.in" => "Jenis kelamin tersebut tidak resmi",
//            "nis.required" => "Kolom NIS wajib diisi!",
//            "nis.numeric" => "Kolom NIS hanya berisi angka & berbentuk numeric",
//            "nis.unique" => "NIS tersebut sudah digunakan!",
//            "nisn.required" => "Kolom NISN wajib diisi!",
//            "nisn.numeric" => "Kolom NISN hanya berisi angka & berbentuk numeric",
//            "nisn.unique" => "NISN tersebut sudah digunakan!",
//            "phone_number.required" => "Kolom No. Handphone Wajib diisi!",
//            "phone_number.numeric" => "Kolom No. Handphone hanya berisi angka saja",
//            "phone_number.unique" => "No. Handphone tersebut sudah digunakan orang lain"
//        ]);

        try
        {
//            $comparison = collect($data);
//            jika data yang dimasukan sama persis dengan data yang ada di db, maka keluar dari method ini
//            if($comparison->except("password", "photo_profile")->toArray() ==
//                $user?->request_data_profile()?->first()?->only("name", "gender", "email", "class_id", "nis", "nisn", "phone_number", "no_absen"))
//            {
//                $this->view = "text";
//                session()->flash("failed", "Gagal mengajukan perubahan data, karena data yang dimasukan sama seperti data sebelumnya!");
//                return;
//            }
            if($this->password)
            {
                $data["password"] = $data["password"] === '' ? '' : bcrypt($this->password);
            }

//            jika user mengunggah foto dan nama file yang diunggah tidak sama dengan nama file yang sudah menjadi foto profil
            if($this->photo_profile && explode("_", auth()->user()->profile->photo_profile)[1] !== $this->photo_profile->getClientOriginalName())
            {
                $photo_name = uniqid() . "_" . $this->photo_profile->getClientOriginalName();
                $this->photo_profile->storeAs("public/photo_profil_student", $photo_name, "public");

                if(Storage::exists("livewire-tmp"))
                {
                    Storage::deleteDirectory("livewire-tmp");
                }
                $data["photo_profile"] = $photo_name;
            }

            $user->request_data_profile()->updateOrCreate(["user_id" => auth()->id()], $data);
            $this->view = "text";
            $this->photo_profile = null;
            session()->flash("success", "Berhasil mengajukan perubahan data ke Wali Kelas");
        }
        catch(\Exception $e)
        {
            abort(403, "Server Error!");
        }
    }

    public function textView()
    {
        $this->view = "text";
        if($this->photo_profile)
        {
            if(Storage::exists("livewire-tmp"))
            {
                Storage::deleteDirectory("livewire-tmp");
            }
        }

        $this->photo_profile = null;
    }
}

//$comparison->only("name", "email", "gender")->toArray()
//=== User::find(auth()->id())->only("name", "email", "gender")
//&& $comparison->only("class_id", "nis", "nisn", "phone_number")->toArray()
//=== Profile::firstWhere("user_id", auth()->id())->only("class_id", "nis", "nisn", "phone_number")