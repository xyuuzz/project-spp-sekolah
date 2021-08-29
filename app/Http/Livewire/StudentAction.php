<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use App\Models\{Profile, SchoolClass, User};
use Livewire\{Component, WithFileUploads};

class StudentAction extends Component
{
    use WithFileUploads;

    public $name, $photo, $gender, $email, $class, $nis, $nisn, $address, $number_phone, $status, $id_user;

    protected $listeners = [
        "visibleView"
    ];

    public function mount()
    {
        $this->status = "index";
    }

    public function render()
    {
        return view('livewire.student-action');
    }

    public function visibleView(User $user)
    {
        if (isset($user))
        {
            $this->id_user = $user->id;
            $this->name = $user->name;
            $this->gender = $user->gender;
            $this->email = $user->email;
            $this->class = $user->profile->class->class;
            $this->nis = $user->profile->NIS;
            $this->nisn = $user->profile->NISN;
            $this->address = $user->profile->address;
            $this->number_phone = $user->profile->number_phone;
        }
    }

    public function destroy()
    {
        $user = User::find($this->id_user);
        $session_data = $user->delete() ? ["success", "Berhasil Menghapus Data Siswa!"] : ["failed", "Terjadi Error saat menghapus Data Siswa!"];

        $this->emit("defaultView", $this->class, $session_data[0], $session_data[1]);
        $this->resetProp();
    }

    public function backToDefaultView()
    {
        if($this->status === "index") {
            $this->emit("defaultView", $this->class);
        } else {
            $this->status = "index";
            $this->photo = null;
        }
    }

    public function submitForm()
    {
        $user = User::find($this->id_user);
        if($this->getErrorBag()->count())
        {
            dd($this->getErrorBag());
        }

        $this->validate(Profile::rules_student($user), Profile::messages_student());

        if($this->photo)
        {
            if(Storage::exists("public/photo_profile_student/{$user->profile->photo_profile}"))
            {
                Storage::delete("public/photo_profile_student/{$user->profile->photo_profile}");
            }

            $photo_name = uniqid() . $this->photo->getClientOriginalName();
            $this->photo->storeAs("photo_profile_student", $photo_name, "public");

            if(Storage::exists("livewire-tmp"))
            {
                Storage::deleteDirectory("livewire-tmp");
            }
        }

        Profile::updateProfile(get_object_vars($this), $user, $photo_name ?? $user->profile->photo_profile);
        $this->status = "index";
        $this->photo = null;
        session()->flash("success", "Berhasil Mensunting Data Siswa!");
    }

    public function resetProp()
    {
        $this->name =  $this->gender = $this->email = $this->class = $this->nis = $this->nisn  = $this->address = $this->number_phone = $this->photo = null;
    }
}
