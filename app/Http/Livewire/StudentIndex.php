<?php

namespace App\Http\Livewire;

use Livewire\Component;

class StudentIndex extends Component
{
    private $status_pembayaran, $pembayaran_terakhir;

    // protected $listeners = [
    //     "updatePembayaranSpp" => 'getStatusPembayaran'
    // ];

    public function mount()
    {
        $this->pembayaran_terakhir = auth()->user()
                                ?->spp_transaction()
                                ?->latest()
                                ?->first();

        // cek apakah pembayaran sudah dibuat bulan ini
        $pembayaran_bulan_ini = $this->pembayaran_terakhir
                                ?->created_at
                                ?->format("m") === now()->format("m");

        // cek apakah pembayaran belum kadaluarsa
        $apakah_pembayaran_valid = $this->pembayaran_terakhir?->kadaluarsa > now();

        if($pembayaran_bulan_ini && $apakah_pembayaran_valid)
        {
            $this->status_pembayaran = $this->pembayaran_terakhir->status;
        }
    }

    public function render()
    {
        return view('livewire.student-index', [
            "status_pembayaran" => $this->status_pembayaran,
            "pembayaran" => $this->pembayaran_terakhir
        ])->layoutData(["title" => "Halaman Siswa", "status_pembayaran" => $this->status_pembayaran]);
    }

    // public function getStatusPembayaran()
    // {
    //     $pembayaran_terakhir = auth()->user()
    //                             ?->spp_transaction()
    //                             ?->latest()
    //                             ?->first();
    //     // untuk menampung apakah pembayaran sudah di konfirmasi atau belum
    //     $pembayaran_bulan_ini = $pembayaran_terakhir
    //                             ?->created_at
    //                             ?->format("m") === now()->format("m");
    //     $apakah_pembayaran_valid = $pembayaran_terakhir?->kadaluarsa > now();
    //     if($pembayaran_bulan_ini && $apakah_pembayaran_valid)
    //     {
    //         $this->status_pembayaran = $pembayaran_terakhir->status;
    //     }
    // }
}
