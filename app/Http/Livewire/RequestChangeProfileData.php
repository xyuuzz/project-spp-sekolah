<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\{WithFileUploads, Component};
use App\Models\{SchoolClass, Profile};

class RequestChangeProfileData extends Component
{
    use WithFileUploads;

    public $name, $password, $email, $class_id, $gender, $phone_number, $nisn, $nis, $view, $no_absen, $photo_profile, $confirm;

    public function mount()
    {
        $profile = auth()->user()?->profile;
        $this->view = "text";
        $this->confirm = $profile->request_change_profile_data?->status ?? null;
    }

    public function render()
    {
        return view('livewire.request-change-profile-data');
    }

    public function submitForm()
    {
        $user = auth()->user();
        $data = $this->validate(
            Profile::rules_student($user, photo_profile: isset($this->photo_profile), password: $this->password ?? true),
            Profile::messages_student()
        );

        try
        {
            if($this->password)
            {
                $data["password"] = $data["password"] === '' ? $user->getAuthPassword() : bcrypt($this->password);
            }

            if($this->photo_profile)
            {
                $photo_name = uniqid() . "_" . $this->photo_profile->getClientOriginalName();
                $this->photo_profile->storeAs("photo_profile_student", $photo_name, "public");

                if(Storage::exists("livewire-tmp"))
                {
                    Storage::deleteDirectory("livewire-tmp");
                }

                $data["photo_profile"] = $photo_name;
            }

            $data["status"] = 0;

            $user->profile->request_change_profile_data()->updateOrCreate(["profile_id" => $user->profile->id], $data);
            $this->view = "text";
            $this->photo_profile = null;
            session()->flash("success", "Berhasil mengajukan perubahan data ke Wali Kelas");
        }
        catch(\Exception $e)
        {
            abort(403, "Server Error!");
        }
    }

//    method akan dipanggil ketika user menekan tombol kembali pada saat mengajukan perubahan data profil
    public function changeView()
    {
        if($this->view === "form")
        {
            $this->view = "text";
            if($this->photo_profile)
            {
                if(Storage::exists("livewire-tmp"))
                {
                    Storage::deleteDirectory("livewire-tmp");
                }
            }
            $this->resetData();
            $this->photo_profile = null;
        }
        elseif($this->view === "text")
        {
//        cari data pertama dari relasi request data profile, jika tidak ada ambil data user auth
            $user = auth()->user()?->profile?->request_change_profile_data ?? auth()->user();

            $this->no_absen = $user?->profile?->no_absen ?? $user->no_absen;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->gender = $user->gender;
            $this->class_id = $user?->profile?->class?->class_id ?? $user->class_id;
//
            $this->phone_number = $user?->profile?->phone->phone_number ?? $user->phone_number;
//
            $this->nisn = $user?->profile?->nisn ?? $user->nisn;
            $this->nis = $user?->profile?->nis ?? $user->nis;
            $this->password = "";

            $this->view = "form";
        }
    }

    protected function resetData()
    {
        $this->name = $this->no_absen = $this->email = $this->gender = $this->class_id = $this->photo_profile = $this->phone_number = $this->nisn = $this->nis = $this->password = "";
    }
}

//$comparison->only("name", "email", "gender")->toArray()
//=== User::find(auth()->id())->only("name", "email", "gender")
//&& $comparison->only("class_id", "nis", "nisn", "phone_number")->toArray()
//=== Profile::firstWhere("user_id", auth()->id())->only("class_id", "nis", "nisn", "phone_number")


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
