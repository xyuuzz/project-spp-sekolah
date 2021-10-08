<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use App\Models\{ClassRelationship, Profile, SchoolClass, User};
use Livewire\{Component, WithFileUploads};
use function dd;
use function implode;

class StudentAction extends Component
{
    use WithFileUploads;

    public $name, $photo, $gender, $email, $class_id, $nis, $nisn, $phone_number, $status, $id_user, $photo_profile, $no_absen;

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
//        jika user nya avaible maka :
        if (isset($user))
        {
            $this->id_user = $user->id;
            $this->name = $user->name;
            $this->gender = $user->gender;
            $this->email = $user->email;
            $this->class_id = $user->profile->class->class->class;
            $this->nis = $user->profile->nis;
            $this->nisn = $user->profile->nisn;
            $this->address = $user->profile->address;
            $this->phone_number = $user->profile->phone->phone_number;
            $this->photo = $user->profile->photo_profile;
            $this->no_absen = $user->profile->no_absen;
        }
        else
        {
            abort(404);
        }
    }

    public function destroy()
    {
        $user = User::find($this->id_user);
        try
        {
            if(Storage::exists("public/photo_profile_student/{$user->profile->photo_profile}") && $user->profile->photo_profile !== "default.png")
            {
                Storage::delete("public/photo_profile_student/{$user->profile->photo_profile}");
            }
            $user->profile->class()->delete();
            $user->profile->phone()->delete();
            $user->delete();

            $session_data = ["success", "Berhasil Menghapus Data Siswa!"];
        }
        catch(\Exception $ex)
        {
            $session_data = ["failed", "Terjadi Error saat menghapus Data Siswa!"];
        }


        $this->emit("defaultView", $this->class_id, $session_data[0], $session_data[1]);
        $this->resetProp();
    }

    public function backToDefaultView()
    {
        if($this->status === "index")
        {
            $this->emit("defaultView", $this->class_id);
        }
        else
        {
            $this->resetErrorBag();
            $this->status = "index";
            $this->photo_profile = null;
        }
    }

    public function submitForm()
    {
//        pertama jadikan value class_id yang semula adalah nama classnya menjadi id nya
        $this->class_id = is_string($this->class_id) ? SchoolClass::firstWhere("class", $this->class_id)->id : $this->class_id;

//        jika no absen sudah digunakan / cari profile yang memiliki id_class yang sama dan no absen yang sama dengan siswa yang sedang di sunting, lalu hitung jumlah nya, jika no absen ada yang kembar, maka otomatis bernilai > 1
        if(Profile::whereHas("class", fn($q) => $q->where("class_id", $this->class_id))->where("no_absen", $this->no_absen)->count() > 1)
        {
            $this->addError("no_absen", "No. Absen sudah digunakan!");
            return;
        }

        $user = User::findOrFail($this->id_user);
        $data = $this->validate(Profile::rules_student($user, password: false, photo_profile: isset($this->photo_profile)), Profile::messages_student());

//        jika user meng-upload foto profil baru..
        if($this->photo_profile)
        {
//            jika file photo_profile user yang lama ada & valuenya tidak default.png, maka hapus foto tsb
            if(Storage::exists("public/photo_profile_student/{$user->profile->photo_profile}") && $user->profile->photo_profile !== "default.png")
            {
                Storage::delete("public/photo_profile_student/{$user->profile->photo_profile}");
            }

//            beri nama foto & store ke server
            $photo_name = uniqid() . $this->photo_profile->getClientOriginalName();
            $this->photo_profile->storeAs("photo_profile_student", $photo_name, "public");

//            jika ada dir livewire-tmp, maka hapus
            if(Storage::exists("livewire-tmp"))
            {
                Storage::deleteDirectory("livewire-tmp");
            }
        }


        $data["photo_profile"] = $photo_name ?? $user->profile->photo_profile;
        Profile::updateProfile(collect($data), $user);
        $this->status = "index";
        $this->photo_profile = null;
        session()->flash("success", "Berhasil Mensunting Data Siswa!");

//        setelah berhasil, kirimkan emit ke diri sendiri bernama visibleView dan mengirimkan var user sebagai argument
        $this->emitSelf("visibleView", $user);
    }

    public function resetProp()
    {
        $this->name =  $this->gender = $this->email = $this->class_id = $this->nis = $this->nisn  = $this->address = $this->phone_number = $this->photo_profile = null;
    }
}
