<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StudentIndex extends Component
{
    public function render()
    {
//        untuk menampung apakah pembayaran sudah di konfirmasi atau belum
        $status_pembayaran = \App\Models\Profile::status_pembayaran();

        return view('livewire.student-index', compact("status_pembayaran"))
                ->layoutData(["title" => "Halaman Siswa", "status_pembayaran" => $status_pembayaran]);
    }
}
