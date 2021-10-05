<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Student extends Component
{
    public function render()
    {
//        untuk menampung apakah pembayaran sudah di konfirmasi atau belum
        $status_pembayaran = \App\Models\Profile::status_pembayaran();

        return view('livewire.student')->layoutData(["title" => "Halaman Siswa", "status_pembayaran" => $status_pembayaran])->withStatusPembayaran($status_pembayaran);
    }
}
