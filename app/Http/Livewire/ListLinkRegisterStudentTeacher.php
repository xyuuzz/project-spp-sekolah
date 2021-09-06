<?php

namespace App\Http\Livewire;

use App\Models\{LinkRegister, SchoolClass};
use Livewire\{WithPagination, Component};

class ListLinkRegisterStudentTeacher extends Component
{
    use WithPagination;
    public $status, $view, $link, $class, $valid_from, $valid_until;

    public function mount()
    {
        $this->link = '';
        $this->status = "student";
    }

    protected $listeners = [
        "updateClass" => "updateListClass", // emit dari list class, untuk mengupdate list class
        "updateData" => "updateListLink", // untuk meng-update link nya, ketika class dihapus
        "changeDataTable" // untuk mengganti data table berdasarkan row
    ];

    public function render()
    {
//        pilih value role yang sesuai dengan value prop status, lalu paginate datanya, lalu sort dengan relasi class secara ASC.
        $list_link = LinkRegister::where("role", $this->status)
                                ?->paginate(5)
                                ?->sortBy(function($query) {
            return $query->class->class;
        });

        return view('livewire.list_link_register_student_teacher.list-link-register-student-teacher', compact("list_link"));
    }

    public function destroyLink($created_at_field)
    {
        if( LinkRegister::firstWhere("created_at", $created_at_field)?->delete() ) {
            $this->view = '';

            $info = $this->status === 'student' ? 'siswa!' : 'guru!';
            session()->flash("success", "Berhasil Menghapus Link pendaftaran $info");
        } else {
            abort(500, "Server Error, Please Reload the Page");
        }
    }

    public function submit()
    {
        $data_validate = $this->validate([
            "link" => 'string|min:4|unique:link_registers,link',
            'class' => "required|in:" . SchoolClass::getAllClass(),
            'valid_from' => 'required|date|after:yesterday',
            'valid_until' => 'required|date|after:valid_from',
        ], [
            "link.string" => "Kolom ini Harus berupa string atau tulisan",
            "link.min" => "Panjang minimal tulisan adalah 4 huruf",
            "class.required" => "Wajib memilih satu pilihan!",
            "valid_from.required" => "Wajib memilih tanggal aktif link!",
            "valid_from.date" => "Tanggal aktif link Wajib berupa tanggal!",
            "valid_from.yesterday" => "Hari Kemarin tidak bisa dipilih!",
            "valid_until.required" => "Wajib memilih tanggal kadaluarsa link!",
            "valid_until.date" => "Tanggal kadaluarsa link Wajib berupa tanggal!",
            "valid_until.after" => "Pilih Tanggal setelah Tanggal Aktif!",
        ]);

        $data_validate["role"] = $this->status;
//        ketika input link diisi, maka ubah value menjadi bentuk slug, jika tidak diisi maka hilangkan data link dari request
        if(strlen($this->link)) {
            $data_validate["link"] = \Str::slug($data_validate["link"]);
        } else {
            $data_validate = collect($data_validate)->except("link")->toArray();
        }

        if( SchoolClass::firstWhere("class", $this->class)
                       ?->register_link()
                       ?->create($data_validate) ) {
            $this->view = '';
            $this->resetInput();

            $info = $this->status === "student" ? "siswa!" : "guru!";
            session()->flash("success", "Berhasil Membuat Link pendaftaran $info");
        } else {
            abort(500, "Server Error, Please Reload This Page");
        }
    }

//    kembali ke view index / table dari create/view form
    public function backToIndexView()
    {
        $this->view = '';
        $this->resetErrorBag();
        $this->resetInput();
    }

//    untuk mereset semua value / input
    protected function resetInput()
    {
        $this->link = $this->class = $this->valid_from = $this->valid_until = '';
    }

//    emit => ketika class ditambahkan maka akan diupdate
    public function updateListClass(){  }

//    emit => ketika class yang berhubungan dengan link dihapus, maka link juga akan ikut hilang & diupdate
    public function updateListLink($status)
    {
        if($status === "delete class") {
            session()->flash("success", "Menghapus Link Kelas yang terhubung dengan kelas yang baru di hapus!");
        }
    }

//    emit => ketika data table dihapus, antara student & teacher
    public function changeDataTable($status)
    {
        $this->status = $status;

        $this->view = '';
        $this->resetInput();
        $this->resetErrorBag();
        $this->resetPage();
    }
}
