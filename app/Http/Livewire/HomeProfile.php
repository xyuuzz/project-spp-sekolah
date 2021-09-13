<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeProfile extends Component
{
    public function render()
    {
        return view('livewire.home-profile')->layoutData(["title" => "Profil Siswa"]);
    }
}
