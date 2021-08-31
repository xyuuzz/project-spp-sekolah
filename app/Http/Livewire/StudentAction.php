<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use App\Models\{Profile, SchoolClass, User};
use Livewire\{Component, WithFileUploads};

class StudentAction extends Component
{
    use WithFileUploads;

    public $name, $photo, $gender, $email, $class, $nis, $nisn, $number_phone, $status, $id_user, $photo_profile;

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
            $this->nis = $user->profile->nis;
            $this->nisn = $user->profile->nisn;
            $this->address = $user->profile->address;
            $this->number_phone = $user->profile->number_phone;
            $this->photo_profile = $user->profile->photo_profile;
        }
    }

    public function destroy()
    {
        $user = User::find($this->id_user);
        try
        {
            $user->delete();

            if(Storage::exists("public/photo_profile_student/{$user->profile->photo_profile}") && $user->profile->photo_profile !== "default.png")
            {
                Storage::delete("public/photo_profile_student/{$user->profile->photo_profile}");
            }

            $session_data = ["success", "Berhasil Menghapus Data Siswa!"];
        }
        catch(\Exception $ex)
        {
            $session_data = ["failed", "Terjadi Error saat menghapus Data Siswa!"];
        }


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
        $user = User::findOrFail($this->id_user);
        $this->validate(Profile::rules_student($user), Profile::messages_student());

//        jika user meng-upload foto profil baru..
        if($this->photo)
        {
//            jika file photo_profile user yang lama ada & valuenya tidak default.png, maka hapus foto tsb
            if(Storage::exists("public/photo_profile_student/{$user->profile->photo_profile}") && $user->profile->photo_profile !== "default.png")
            {
                Storage::delete("public/photo_profile_student/{$user->profile->photo_profile}");
            }

//            beri nama foto & store ke server
            $photo_name = uniqid() . $this->photo->getClientOriginalName();
            $this->photo->storeAs("photo_profile_student", $photo_name, "public");

//            jika ada dir livewire-tmp, maka hapus
            if(Storage::exists("livewire-tmp"))
            {
                Storage::deleteDirectory("livewire-tmp");
            }
        }

/*        panggil static method updateProfile dari obj Profile untuk mengupdate profile, kirimkan 3 parameter,
            parameter 1 berisi value var yang ada di objek ini(this),
            parameter 2 berisi obj user yang akan diupdate,
            parameter 3 berisi nilai photo_profile
*/
        Profile::updateProfile(get_object_vars($this), $user, $photo_name ?? $user->profile->photo_profile);
        $this->status = "index";
        $this->photo = null;
        session()->flash("success", "Berhasil Mensunting Data Siswa!");

//        setelah berhasil, kirimkan emit ke diri sendiri bernama visibleView dan mengirimkan var user sebagai argument
        $this->emitSelf("visibleView", $user);
    }

    public function resetProp()
    {
        $this->name =  $this->gender = $this->email = $this->class = $this->nis = $this->nisn  = $this->address = $this->number_phone = $this->photo = null;
    }
}
