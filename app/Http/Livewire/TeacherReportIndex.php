<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TeacherReportIndex extends Component
{
    public function render()
    {
        return view('livewire.teacher-report-index')
            ->layoutData(["title" => "Laporan Guru Kepada Admin"]);
    }
}
