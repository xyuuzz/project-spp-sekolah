<?php

namespace App\Http\Livewire;

use App\Models\{Profile, User};
use Livewire\{Component, WithPagination};

class ListStudentTeacher extends Component
{
    use WithPagination;

    public $grade, $status, $placeholder_input_search, $name, $gender, $email, $class_teacher, $slug, $search, $choiceType;

    protected $listeners = [
        "switchClass" => "class",
        "toTeacher"
    ];

    public function mount($grade)
    {
        $this->choiceType = "name";
        $this->placeholder_input_search = "Cari siswa berdasarkan Nama, Email, NIS & Kelas";
        $this->status = "student";
        $this->grade = $grade;
        $this->search = "";
    }

    public function render()
    {
//        jika input search ada tulisan, maka panggil method searchQuery, jika tidak panggil method paginate
        $data = strlen($this->search) >= 1 ? $this->searchQuery($this->grade) :
            ( $this->status === "student" ? Profile::data_siswa($this->grade) : User::data_guru() )->paginate(7);

        return view('livewire.list-student-teacher', compact("data"));
    }

//    ketika mengeklik card class, maka ubah view table, dari siswa kelas 7 menjadi kelas yg lain atau dari data guru menjadi data siswa
    public function class($grade)
    {
//        reset page
        $this->resetPage();
//        untuk mereset value dari form updateTeacher, ketika user sebelumnya melakukan update data pada teacher
        $this->reset_teacher_field();
//        reset input query search
        $this->search = "";

        $this->status = "student";
        $this->placeholder_input_search = "Cari siswa berdasarkan Nama, Email, NIS & Kelas";
        $this->grade = $grade;
    }

//    mengubah view table, dari data siswa menjadi data guru
    public function toTeacher()
    {
//        reset page
        $this->resetPage();
//        untuk mereset value dari form updateTeacher, ketika user sebelumnya melakukan update data pada teacher
        $this->reset_teacher_field();

        $this->placeholder_input_search = "Cari Guru Berdasarkan Kelas & Email";
        $this->status = "teacher";
    }

//    jika tombol lihat selengkapnya pada table siswa ditekan
    public function showStudent($slug)
    {
        $user = User::where("slug", $slug)->firstOrFail();
        $this->emit("readMoreStudent", $user);
    }

//    untuk menghapus field teacher
    public function destroyTeacher($slug)
    {
        $user = User::firstWhere("slug", $slug);
        $user->delete();

        session()->flash("success", "Berhasil Menghapus Data Guru!");
        return redirect()->back();
    }

//    untuk mengubah view dari text menjadi form input
    public function editTeacher($slug)
    {
        $user = User::firstWhere("slug", $slug);
        $this->fill_teacher_field($user);

//        untuk mereset error ketika field sebelumnya terdapat error & tidak/belum diperbaiki dan langsung loncat ke field yg lain
        $this->resetErrorBag();
    }

//    untuk mengubah field teacher
    public function updateTeacher()
    {
        $this->validate( User::rules_teacher($this->slug), User::messages_teacher() );

        $user = User::firstWhere("slug", $this->slug);
//        update field user
        $user->update([
            "name" => $this->name,
            "email" => $this->email,
            "gender" => $this->gender,
        ]);

//        hapus class lama yg diajar oleh guru tsb
//        $user->class_teacher()->detach();
//       lalu isi dengan yang baru
//        $user->class_teacher()->attach($this->class_teacher);

        $this->reset_teacher_field();
        session()->flash("success", "Berhasil Mensunting Data Guru!");
        return redirect()->back();
    }

//    untuk mengisi field teacher, digunakan ketika akan mengupdate data / yang lain
    protected function fill_teacher_field($user)
    {
        $this->name = $user->name;
        $this->slug = $user->slug;
        $this->gender = $user->gender;
        $this->email = $user->email;
        $this->class_teacher = $user->class_teacher->class->class;
    }

//    untuk mereset prop field teacher, digunakan ketika setelah mengupdate data / yang lain
    protected function reset_teacher_field()
    {
//        melakukan mass assignment terhadap semua prop yg dimiliki oleh obj User yg memiliki role teacher
        $this->slug = $this->gender = $this->email = $this->class_teacher = $this->name = "";
    }

//    method untuk aksi search field untuk query input search
    protected function searchQuery()
    {
        if($this->choiceType === "name")
        {
            return $this->status === "teacher" ?
                User::data_guru()->where("name", "like", "%{$this->search}%")->get()
                : Profile::searchWithName($this->grade, $this->search);
        }
        else if($this->choiceType === "email")
        {
            return $this->status === "teacher" ?
                User::data_guru()->where("email", "like", "%{$this->search}%")->get()
                : Profile::searchWithEmail($this->grade, $this->search);
        }
        else if($this->choiceType === "class")
        {
            return $this->status === "teacher" ?
                User::searchWithTeacherClass($this->search)
                : Profile::searchWithClass($this->grade, $this->search);
        }
        else if($this->choiceType === "nis")
        {
            return Profile::data_siswa($this->grade)->where("NIS", "like", "%{$this->search}%")
                        ->get();
        }

//        abort(401, "Server Error! Please Reload the Page");
//        return 0;
        throw new \Exception("Server Error! Please Reload the Page!");
    }
}
