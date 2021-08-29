<?php

namespace App\Http\Livewire;

use App\Models\SchoolClass;
use Livewire\{Component, WithPagination};
use function strlen;

class ListClass extends Component
{
    use WithPagination;

    public $view, $status, $class, $id_class, $biaya_spp;

    public function mount()
    {
        $this->view = "index";
        $this->status = 'default';
    }

    public function render()
    {
        if(! $this->status)
        {
            //        jika input class ada isinya & input biaya_spp kosong, atau jika input class tidak koosng & ada class yang mirip dengan input class serta input biaya spp nya kosong
            if( ( strlen($this->class) && !strlen($this->biaya_spp) )
                || ( SchoolClass::where("class", "like", "%{$this->class}%")->count() && strlen($this->class) && !strlen($this->biaya_spp))
            )
            {
//            maka isi input biaya spp dengan biaya_spp class yang mirip seperti input class
                $this->biaya_spp = SchoolClass::firstWhere("class", "like", "%{$this->class}%")?->biaya_spp;
            }

            if( !strlen($this->class) && strlen($this->biaya_spp)
                && SchoolClass::where("biaya_spp", $this->biaya_spp)->count()
            )
            {
                $this->biaya_spp = '';
            }
        }

        $classes = SchoolClass::orderBy("class")->paginate(5);
        return view('livewire.list_class.list-class', compact("classes"));
    }

    public function edit($class)
    {
        $c = SchoolClass::firstWhere("class", $class);
        $this->id_class = $c?->id;
        if($this->id_class)
        {
            $this->status = $this->class = $class;
            $this->biaya_spp = $c->biaya_spp;
        } else
        {
            redirect()->abort(500, "Server Error, Please Reload the Page");
        }
    }

    public function update()
    {
        $validate_data = $this->validate([
            "class" => "required|string|unique:school_classes,class,{$this->id_class}",
            "biaya_spp" => "required|numeric"
        ], [
            "class.required" => "Wajib Memilih salah satu kelas!",
            "class.string" => "Harus berbentuk string atau kata",
            "class.unique" => "Kelas yang diinputkan sudah ada"
        ]);

        if( ! SchoolClass::find($this->id_class)->update($validate_data) ) {
            abort(500, "Server Error, Please Reload the Page");
        }

        $this->emit("updateData", "update class");
        $this->status = '';

        session()->flash("success", "Berhasil Mensunting Data Kelas pada Sekolah!");
    }

    public function destroy($class)
    {
        if(
            SchoolClass::firstWhere("class", $class)
                ?->delete()
        ) {
            $info = ["key" => "success", "value" => "Berhasil Menghapus Data Kelas Sekolah"];
        } else {
            abort(500, "Server Error, Please Reload the Page");
        }

        $this->status = "index";
        $this->class = '';

        $this->emit("updateData", "delete class");
        session()->flash($info["key"], $info["value"]);
    }

    public function changeView()
    {
        $this->class = '';
        if($this->view === "index") {
            $this->view = "add";
        } else {
            $this->resetErrorBag();
            $this->view = "index";
        }
    }

    public function addData()
    {
        $validate_data = $this->validate([
            "class" => "required|string|unique:school_classes,class",
            "biaya_spp" => "required|numeric"
        ], [
            "class.required" => "Wajib Memilih salah satu kelas!",
            "class.string" => "Harus berbentuk string atau kata",
            "class.unique" => "Kelas yang diinputkan sudah ada"
        ]);

        if( SchoolClass::create($validate_data) ) {
            session()->flash("success", "Berhasil Mensunting Data Kelas pada Sekolah!");
        } else {
            abort(500, "Server Error, Please Reload the Page");
        }

        $this->emit("updateClass", true);
        $this->class = '';
        $this->view = 'index';
    }

}
