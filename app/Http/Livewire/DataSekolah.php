<?php

namespace App\Http\Livewire;

use Livewire\Component;

class DataSekolah extends Component
{
    public $status;

    public function mount()
    {
        $this->status = "student";
    }

    public function render()
    {
        return view('livewire.data-sekolah');
    }

    public function changeStatus($status)
    {
        $this->emit("changeDataTable", $status);
        $this->status = $status;
    }
}
