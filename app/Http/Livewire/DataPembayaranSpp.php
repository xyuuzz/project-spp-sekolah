<?php

namespace App\Http\Livewire;

use App\Models\StudentPayment;
use Livewire\{WithPagination, Component};

class DataPembayaranSpp extends Component
{
    use WithPagination;

    public $month, $year;

    public function mount()
    {
        $this->month = $this->year = "all";
    }

    public function render()
    {
//        pilih model StudentPayment, lalu lakukan eager loading untuk relasi user, serta lakukan callback function, pada callback function lakukan eager loading terhadap relasi profile pada relasi user milik model StudentPayment, lalu lakukan callback function lagi, untuk melakukan eager loading terhadap class yang dimiliki oleh profile.
        $payments = StudentPayment::with(["user" => function($query) {
            $query->with(["profile" => function($query) {
                $query->with("class");
            }]);
        }]);

        if($this->month !== "all")
        {
            $payments = $payments->whereMonth("created_at", $this->month);
        }
        if($this->year !== "all")
        {
            $payments = $payments->whereYear("created_at", $this->year);
        }

        $payments = $payments->paginate();
        return view('livewire.data_pembayaran.data-pembayaran-spp')->withPayments($payments);
    }
}
