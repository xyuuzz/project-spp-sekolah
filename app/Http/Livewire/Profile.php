<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $name, $class, $email, $gender, $nisn, $nis, $number_phone, $photo_profile, $view;

    public function mount()
    {
        $user = auth()->user();
        $this->name = ucfirst($user->name);
        $this->class = $user->profile->class->class;
        $this->email = $user->email;
        $this->gender = $user->gender;
        $this->nisn = $user->profile->nisn;
        $this->nis = $user->profile->nis;
        $this->number_phone = $user->profile->number_phone;
        $this->photo_profile = $user->profile->photo_profile;

        $this->view = "index";
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
