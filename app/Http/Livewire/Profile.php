<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Profile extends Component
{
    public $name, $class, $email, $gender, $nisn, $nis, $phone_number, $photo_profile, $no_absen, $view;

    public function mount()
    {
        $user = auth()->user();
        $this->name = ucfirst($user->name);
        $this->class = $user->profile->class->class->class;
        $this->email = $user->email;
        $this->gender = $user->gender;
        $this->nisn = $user->profile->nisn;
        $this->nis = $user->profile->nis;
        $this->phone_number = $user->profile->phone->phone_number;
        $this->photo_profile = $user->profile->photo_profile;
        $this->no_absen = $user->profile->no_absen;

        $this->view = "index";
    }

    public function render()
    {
        return view('livewire.profile');
    }
}
