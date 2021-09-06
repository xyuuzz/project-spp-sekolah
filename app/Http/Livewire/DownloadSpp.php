<?php

namespace App\Http\Livewire;

use App\Models\StudentPayment;
use Livewire\Component;
use App\Exports\DownloadSppExport;
use function session;


class DownloadSpp extends Component
{
    public $month, $year, $total;

    public function mount()
    {
        $this->total = 0;
    }

    public function render()
    {
        if($this->month && $this->year)
        {
            $this->total = StudentPayment::whereMonth("created_at", $this->month)
                                         ->whereYear("created_at", $this->year)
                                         ->count();
        }

        return view('livewire.download-spp');
    }

    public function download()
    {
        if($this->total)
        {
            return (new DownloadSppExport())->forMonth($this->month)
                                            ->forYear($this->year)
                                            ->download();
        }

        $this->addError("download_spp", "Tidak ada riwayat Pembayaran di bulan " . date("F", $this->month) . " pada tahun " . date("Y", $this->year));
    }
}
