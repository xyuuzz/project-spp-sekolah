<?php

namespace App\Http\Livewire;

use App\Models\StudentPayment;
use Livewire\Component;
use function session;

class DetailPayment extends Component
{
    public StudentPayment $payment;

    protected $listeners = [
        "dataPayment"
    ];

    public function render()
    {
        return view('livewire.detail-payment');
    }

    public function dataPayment(StudentPayment $payment)
    {
        $this->payment = $payment;
    }

    public function back()
    {
        $this->emit("dataIndex");
    }

    public function destroy(StudentPayment $payment)
    {
        if($payment->delete())
        {
            $this->emit("dataIndex", "destroy");
        }
        else
        {
            session()->flash("failed", "Gagal Menghapus Data Pembayaran!");
        }
    }
}
