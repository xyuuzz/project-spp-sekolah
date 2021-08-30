<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
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
        return view('livewire.login')->layout("livewire.blank_page");
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
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
