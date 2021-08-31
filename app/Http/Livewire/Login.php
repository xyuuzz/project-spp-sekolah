<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\{Auth, Request};
use Livewire\Component;

class Login extends Component
{
    public $email, $password, $remember;

    protected $rules = [
        "email" => "required|email",
        "password" => "required|string"
    ];

    public function render()
    {
        return view('livewire.login')->layout("livewire.blank_page", ["title" => "Login Page"]);
    }

    public function authenticate()
    {
        $credentials = $this->validate();

//        if(User::firstWhere())
//        Auth::login()
        if (Auth::attempt($credentials, $this->remember)) {
            Request::session()->regenerate();
            $user = User::firstWhere("email", $this->email);
            if($user->role === "admin")
            {
                return redirect()->route("admin");
            } else if($user->role === "student")
            {
                return redirect()->route("student");
            }
        }

        $this->addError("email", 'Akun yang anda Masukan tidak ada di dalam data kami!');
    }
}
