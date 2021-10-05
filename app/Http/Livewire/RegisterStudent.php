<?php

namespace App\Http\Livewire;

use App\Models\{ClassRelationship, LinkRegister, Profile, User};
use Livewire\Component;
use function dd;

class RegisterStudent extends Component
{
    public LinkRegister $link_register;
    public $gender, $email, $password, $nis, $nisn, $name, $phone_number, $no_absen, $class_id;

//    protected $rules = [
//        "gender" => "required|string|in:Laki-Laki,Perempuan",
//        "email" => "required|email|unique:users,email",
//        "password" => "required|string|min:6",
//        "nis" => "required|numeric|unique:profiles,nis",
//        "nisn" => "required|numeric|unique:profiles,nisn",
//        "name" => "required|string|unique:users,name",
//        "number_phone" => "required|numeric|unique:profiles,number_phone"
//    ];

    public function mount()
    {
//        jika sekarang kurang dari / belum sampai pada waktu dibuka atau sekarang lebih dari waktu ditutup
        if(now() < $this->link_register->valid_from || now() > $this->link_register->valid_until)
        {
            abort(403, "Link Ditutup!");
            return;
        }
        $this->gender = "Laki-Laki";
        $this->class_id = $this->link_register->class->id;
    }

    public function render()
    {
        return view('livewire.register-student')->layout("livewire.blank_page", ["title" => "Register Page"]);
    }

    public function register()
    {
        $data = $this->validate(Profile::rules_student(photo_profile: false, password: true), Profile::messages_student());
//        panggil method static dari model profile bernama unique_no_absen untuk mengidentifikasi apakah no absen yang diinputkan sudah dipakai oleh teman sekelas.
        if(
            Profile::unique_no_absen($this->link_register->class->id, $this->no_absen)
        ) {
            $this->addError("no_absen", "No.Absen yang anda masukan sudah dipakai!");
            return 0;
        }
//        create data
        $data["password"] = bcrypt($this->password);
        $data["role"] = "student";
        $data["slug"] = uniqid() . "-" . \Str::slug($data["name"]);
        $user = User::create($data);

        $data["photo_profile"] = "default.png";

        $profile = $user->profile()->create($data);
        $profile->class()->create(["class_id" => $data["class_id"]]);
        $profile->phone()->create(["phone_number" => $data["phone_number"]]);

        auth()->login($user);
        return redirect()->route("student");
    }
}
