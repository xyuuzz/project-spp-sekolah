<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class TeacherIndex extends Component
{
    public $view_list_student;
    protected $listeners = [
        "readMoreStudent" => "toViewReadMoreStudent",
        "defaultView" => "toViewListStudent"
    ];

    public function mount()
    {
        $this->view_list_student = true;
    }

    public function render()
    {
        $grade = auth()->user()->class_teacher->class->class;

        return view('livewire.teacher-index', compact('grade'))
            ->layoutData(["title" => "Halaman Wali Kelas"]);
    }

    public function toViewReadMoreStudent(User $user)
    {
        $this->view_list_student = false;
        $this->emitTo("student-action", "visibleView", $user);
    }

    public function toViewListStudent($class='', $status='', $message='')
    {
        $this->view_list_student = true;

        if(strlen($status) && strlen($message))
        {
            session()->flash($status, $message);
        }
    }
}
