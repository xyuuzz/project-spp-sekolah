<?php

namespace App\Http\Livewire;

use Livewire\Component;
use PDF;

class BayarSpp extends Component
{
    public $cara_pembayaran, $statusPembayaran;

    public function mount($statusPembayaran)
    {
        $this->statusPembayaran = $statusPembayaran;
    }

    public function render()
    {
        return view('livewire.bayar_spp.bayar-spp');
    }

    public function submitPembayaranSpp()
    {
        $this->validate();
    }

//    method untuk mencetak struk pembayaran untuk siswa
    public function cetak_struk()
    {
        $pdf = PDF::loadView("template_pdf.struk_pembayaran_untuk_siswa")->setPaper("A4", "potrait");
        return $pdf->stream("Uji Coba.pdf");
    }
}
