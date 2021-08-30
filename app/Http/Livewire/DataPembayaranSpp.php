<?php

namespace App\Http\Livewire;

use App\Models\StudentPayment;
use Livewire\{WithPagination, Component};
use function cache;
use function strlen;

class DataPembayaranSpp extends Component
{
    use WithPagination;

    public $month, $year, $search;

    public function mount()
    {
        $this->month = $this->year = "all";
    }

    public function render()
    {

        $payments = $this->getPayments();
        return view('livewire.data_pembayaran.data-pembayaran-spp')->withPayments($payments);
    }

    protected function getPayments()
    {
//        pilih model StudentPayment, lalu lakukan eager loading untuk relasi user, serta lakukan callback function, pada callback function lakukan eager loading terhadap relasi profile pada relasi user milik model StudentPayment, lalu lakukan callback function lagi, untuk melakukan eager loading terhadap class yang dimiliki oleh profile.
        $payments = StudentPayment::with(["user" => function($query) {
                $query->with(["profile" => function($query) {
                    $query->with("class");
                }]);
            }])->orderByDesc("created_at");

        if($this->month !== "all")
        {
            $payments = $payments->whereMonth("created_at", $this->month);
        }

        if($this->year !== "all")
        {
            $payments = $payments->whereYear("created_at", $this->year);
        }

        if(strlen($this->search))
        {
            $payments = $payments->whereHas("user", function($query) {
                $query->where("name", "like", "%{$this->search}%");
            })
                                 ->orWhereHas("user", function($query) {
                                     $query->whereHas("profile", function ($profiles) {
                                         $profiles->whereHas("class", function($classes) {
                                             $classes->where("class", "like", "%{$this->search}%");
                                         });
                                     });
                                 })
                                 ->orWhere("no_rek", "like", "%{$this->search}%");
        }

        return $payments->paginate(5);
    }
}
