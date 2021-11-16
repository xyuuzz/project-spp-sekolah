<?php

namespace App\Http\Livewire;

use Livewire\Component;

class PembayaranUangKomersial extends Component
{
    public $tipe, $deskripsi, $amount, $start, $end;

    public function render()
    {
        return view('livewire.pembayaran-uang-komersial');
    }


}
