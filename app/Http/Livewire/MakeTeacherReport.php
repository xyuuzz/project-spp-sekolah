<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use Livewire\{Component, WithFileUploads};

class MakeTeacherReport extends Component
{
    use WithFileUploads;

    public $title, $content, $about;
    public $files = [];

    protected $rules = [
        "title" => "required|string|min:5",
        "content" => "required|string|min:15",
        "files.*" => "file|mimes:docx,xlsx,pptx,jpg,jpeg,png,rar,zip,pdf,mp3,mp4|max:2048",
        "about" => "required|string|max:50|min:5",
    ];

    protected $messages = [
        "title.required" => "Kolom Judul Laporan Wajib Diisi!",
        "title.string" => "Kolom Judul wajib berbentuk text",
        "title.min" => "Minimal 5 huruf",
        "content.required" => "Konten  Laporan Wajib Diisi!",
        "content.string" => "Konten Laporan wajib berbentuk text",
        "content.min" => "Minimal 15 huruf",
        "files.*.file" => "Kolom ini wajib berbentuk file!",
        "files.*.max" => "Maximal File yang diunggah adalah 2MB",
        "files.*.mimes" => "Extensi file yang anda unggah tidak didukung! Extensi yang didukung antara lain : file document, gambar, file kompres, mp3 dan mp4",
        "about.required" => "Kolom Perihal Laporan Wajib Diisi!",
        "about.string" => "Kolom Perihal Laporan wajib berbentuk text",
        "about.min" => "Minimal 5 huruf",
        "about.max" => "Maximal 50 huruf"
    ];

    public function render()
    {
        return view('livewire.make-teacher-report');
    }

    public function submit()
    {
        $data = $this->validate($this->rules);
        $report_data = collect($data)->except("files")->toArray();

        $files_name = [];
        foreach($this->files as $file)
        {
            $file_name = uniqid() . "-". auth()->id() ."-" . $file->getClientOriginalName();
            $file->storeAs("report_files", $file_name, "public");

            array_push($files_name, $file_name);
        }

        if( Storage::exists("livewire-tmp") )
        {
            Storage::deleteDirectory("livewire-tmp");
        }

        // mengubah sp / special character \n menjadi tag <br>
        $report_data["content"] = implode("<br>", explode("\n", $report_data["content"]));
        $report_data["reply"] = "not yet";
        $report = auth()->user()->teacher_report()->create($report_data);

        if(count($files_name))
        {
            collect($files_name)->map(fn($file) => $report->report_files()->create(["file" => $file]));
        }

        $this->resetInput();
        session()->flash("success", "Berhasil Mengirim Laporan ke Admin");

        // kirimkan emit ke component list teacher report untuk merefresh component nya.
        $this->emit("updateView");
    }

    public function resetInput()
    {
        $this->title = $this->content = $this->about = '';
        $this->files = [];
    }
}
