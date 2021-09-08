<?php

namespace App\Http\Livewire;

use Livewire\Component;

class BayarSpp extends Component
{
    public $cara_pembayaran;

    public function mount()
    {
        $this->cara_pembayaran = "same_bank";
    }

    public function render()
    {
        return view('livewire.bayar_spp.bayar-spp');
    }
}
