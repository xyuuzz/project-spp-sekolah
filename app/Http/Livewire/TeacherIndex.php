<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TeacherIndex extends Component
{
    public function render()
    {
        $grade = auth()->user()->class_teacher->class->class;
        return view('livewire.teacher-index')
            ->layoutData(["title" => "Halaman Wali Kelas"])
            ->withGrade($grade);
    }
}
