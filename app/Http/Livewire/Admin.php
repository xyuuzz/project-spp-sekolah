<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Admin extends Component
{
    public $active_table = "7";
    public $title = "Admin Website Pembayaran SPP Siswa";

    protected $listeners = [
        "readMoreStudent" => "toViewReadMoreStudent",
        "defaultView",
    ];

    public function render()
    {
        return view('livewire.admin');
    }

    public function SwitchDataTable($data)
    {
//        buat kondisi jika data yang diterima adalah data yg valid, maka jalankan perintah selanjutnya
        $valid_data = ["7", "8", "9", "teacher"];
//        metode seperti ini, sama saja dengan menuliskan $data === "7" || $data === "8" || $data === "9" || $data === "teacher"
        if(array_search($data, $valid_data) !== false)
        {
            $this->active_table = $data;
            // jika data adalah teacher, maka kirim emit bernama toTeacher, jika tidak maka kirim emit dengan nama switchClass
            $this->emit($data === "teacher" ? "toTeacher" : "switchClass", $data);
        }
    }

    public function toViewReadMoreStudent(User $user)
    {
        $this->active_table = false;
        $this->emitTo("student-action", "visibleView", $user);
    }

//    method yang dikirim dari controller StudentAction, menerima parameter class, status message & isi message
    public function defaultView($class, $status = "", $message = "")
    {
        $this->active_table = $class[0];
//        Jika ada message yang dikirimkan..
        if(strlen($status) && strlen($message))
        {
            session()->flash($status, $message);
        }
    }
}
