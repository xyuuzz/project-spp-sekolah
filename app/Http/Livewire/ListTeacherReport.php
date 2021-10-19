<?php

namespace App\Http\Livewire;

use App\Models\TeacherReport;
use Illuminate\Support\Facades\DB;
use Livewire\{Component, WithPagination};

class ListTeacherReport extends Component
{

    use WithPagination;

    public $see_reply = 0, $see_uploaded_file = 0;

    protected $listeners = [
        "updateView" => '$refresh'
    ];

    public function mount()
    {
        if(
            DB::table("teacher_reports")
                ->whereRaw('DATEDIFF(CURDATE(),DATE_FORMAT(deleted_at,"%Y-%m-%d")) > 30')
                ->delete()
        )
        {
            session()->flash("warning", "Laporan yang anda urungkan 30 hari yang lalu telah dihapus!");
        }
    }

    public function render()
    {
        $list_laporan = auth()->user()->teacher_report()->with("report_files")
                        ->withTrashed()
                        ->orderBy("deleted_at", "asc")
                        ->latest()
                        ->paginate(3);
                        // ->take(3)->get();
        return view('livewire.list_teacher_report.list-teacher-report', compact("list_laporan"));
    }

    public function undoData(TeacherReport $teacherReport)
    {
        try {
            $teacherReport->delete();
            session()->flash("success", "Berhasil menarik kembali laporan!");
        } catch(\Exception $err) {
            abort(403, "Server Error! Harap Reload Halaman ini");
        }
    }

    public function restoreData($idTeacherReport)
    {
        try {
            TeacherReport::withTrashed()->find($idTeacherReport)->restore();
            session()->flash("success", "Berhasil mengirim kembali laporan ke Admin!");
        } catch(\Exception $err) {
            abort(403, "Server Error! Harap Reload Halaman ini");
        }
    }

    public function deleteData($idTeacherReport)
    {
        try {
            TeacherReport::withTrashed()->find($idTeacherReport)->forceDelete();
            session()->flash("success", "Berhasil menghapus permanent laporan!");
        } catch(\Exception $err) {
            abort(403, "Server Error! Harap Reload Halaman ini");
        }
    }

}
