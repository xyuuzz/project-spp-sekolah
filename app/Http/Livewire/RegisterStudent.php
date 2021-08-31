<?php

namespace App\Http\Livewire;

use App\Models\LinkRegister;
use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function abort;
use function redirect;

class RegisterStudent extends Component
{
    public LinkRegister $link_register;
    public $gender, $email, $password, $nis, $nisn, $name, $number_phone, $class;

    protected $rules = [
        "gender" => "required|string|in:Laki-Laki,Perempuan",
        "email" => "required|email|unique:users,email",
        "password" => "required|string|min:6",
        "nis" => "required|numeric",
        "nisn" => "required|numeric",
        "name" => "required|string|unique:users,name",
        "number_phone" => "required|numeric|unique:profiles,number_phone"
    ];

    public function mount()
    {
        $this->gender = "Laki-Laki";
    }

    public function render()
    {
        return view('livewire.register-student')->layout("livewire.blank_page", ["title" => "Register Page"]);
    }

    public function register()
    {
        $data = $this->validate();

        $user_data = collect($data)->only("name", "gender", "email", "password")->toArray();
        $user_data["password"] = bcrypt($this->password);
        $user_data["role"] = "student";
        $user_data["slug"] = uniqid() . "-" . $user_data["name"];

        $user = User::create($user_data);

        $profile_data = collect($data)->except("name", "gender", "email", "password")->toArray();
        $profile_data["class_id"] = $this->link_register->class->id;
        $profile_data["photo_profile"] = "default.jpg";

        $user->profile()->create($profile_data);

        Auth::login($user);
        if($user->role === "admin")
        {
            return redirect()->route("admin");
        } else if($user->role === "student")
        {
            return redirect()->route("student");
        }

        abort(502);
    }
}
