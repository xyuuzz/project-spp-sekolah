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

        if(ClassRelationship::where([
            "class_id" => $this->link_register->class->id,
            "referensi_type" => "\App\Models\Profile"
        ])->get()->filter(fn($query) => $query->posession->no_absen === $this->no_absen)->count()
        ) {
            $this->addError("no_absen", "No.Absen yang anda masukan sudah dipakai!");
            return 0;
        }
//        create data
        $user_data = collect($data)->toArray();
        $user_data["password"] = bcrypt($this->password);
        $user_data["role"] = "student";
        $user_data["slug"] = uniqid() . "-" . $user_data["name"];

        $user = User::create($user_data);

        $profile_data = collect($data)->except("name", "gender", "email", "password")->toArray();
        $profile_data["photo_profile"] = "default.png";

        $profile = $user->profile()->create($profile_data);
        $profile->class()->create(["class_id" => $this->class_id]);

        auth()->login($user);
        return redirect()->route("student");
    }
}
