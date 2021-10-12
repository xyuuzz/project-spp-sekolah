<?php

namespace App\Http\Livewire;

use App\Models\TeacherReport;
use Livewire\{Component, WithPagination};

class ListTeacherReport extends Component
{
    use WithPagination;

    protected $listeners = [
        "updateView" => '$refresh'
    ];

    public $see_reply = 0, $see_uploaded_file = 0;

    public function render()
    {
        $list_laporan = auth()->user()->teacher_report()->with("report_files")->latest()->paginate(3);
        return view('livewire.list-teacher-report', compact("list_laporan"));
    }
}
