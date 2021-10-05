<?php

namespace App\Http\Livewire;

use Livewire\Component;

class HomeProfile extends Component
{
    public function render()
    {
        $status_pembayaran = \App\Models\Profile::status_pembayaran();

        return view('livewire.home-profile')
            ->layoutData(["title" => "Profil Siswa", "status_pembayaran" => $status_pembayaran])->with(["status_pembayaran" => $status_pembayaran]);
    }
}
