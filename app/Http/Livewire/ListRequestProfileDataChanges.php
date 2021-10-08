<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Storage;
use App\Models\{RequestChangeDataProfileStudent, SchoolClass, Profile};
use Livewire\Component;
use function dd;
use function redirect;
use function session;
use function uniqid;

class ListRequestProfileDataChanges extends Component
{
    public $list_profile_request;
    public $grade, $name, $gender, $email, $password, $no_wa, $class, $no_absen, $nis, $nisn, $phone_number;
//$n_name, $n_gender, $n_email, $n_password, $n_no_wa, $n_class, $n_no_absen, $n_nis, $n_nisn, $name, $gender, $email, $password, $no_wa, $class, $no_absen, $nis, $nisn

    public function render()
    {
        return view('livewire.list-request-profile-data-changes')
            ->with(["list_profile_request" => $this->list_profile_request ?? []]);
    }

    public function mount($grade)
    {
//        $this->list_profile_request = SchoolClass::firstWhere("class", $grade)->request_data_profile;
//        $this->list_profile_request = Profile::whereHas("class", function($query) use($grade) {
//           $query->whereHas("class", function($query2) use($grade) {
//               $query2->where("class", $grade);
//           });
//        })->get()
//          ->map(fn($q) => $q->request_change_profile_data);

        $this->list_profile_request = RequestChangeDataProfileStudent::getRequestDataOnGrade($grade);
        $this->grade = $grade;
    }

    public function request_decline(RequestChangeDataProfileStudent $requestChangeDataProfileStudent)
    {
        try {
            $requestChangeDataProfileStudent->update(["status" => -1]);
            session()->flash("success","Aksi menolak permintaan perubahan data Siswa berhasil!");
        } catch(\Exception $err) {
            session()->flash("failed","Gagal melakukan aksi yang diminta karena ada kesalahan server!");
        }

        $this->list_profile_request = RequestChangeDataProfileStudent::getRequestDataOnGrade($this->grade);
    }

    public function request_accept(RequestChangeDataProfileStudent $requestChangeDataProfileStudent)
    {
        try {
            $data_array = $requestChangeDataProfileStudent->toArray();
            $profile = $requestChangeDataProfileStudent->profile;

            if($data_array["photo_profile"] === $profile->photo_profile && Storage::exists("public/photo_profile_student/{$data_array['photo_profile']}") && $profile->photo_profile !== "default.png")
            {
//              jika file photo_profile user yang lama ada & valuenya tidak default.png, maka hapus foto tsb
                Storage::delete("public/photo_profile_student/{$data_array['photo_profile']}");
            }

            $profile->user()->update($requestChangeDataProfileStudent->only("name", "gender", "email", "password"));

            $profile->update($requestChangeDataProfileStudent->only("nisn", "nis", "no_absen", "photo_profile"));


            $profile->phone()->update($requestChangeDataProfileStudent->only("phone_number"));
            $profile->class()->update($requestChangeDataProfileStudent->only("class_id"));
            $requestChangeDataProfileStudent->update(["status" => 1]);

            session()->flash("success", "Berhasil! Perubahan data Siswa akan segera diterapkan!");
            $this->emit("updateDataSiswa");
        } catch(\Exception $err) {
            session()->flash("failed","Gagal melakukan aksi yang diminta karena ada kesalahan server!");
        }

        $this->list_profile_request = RequestChangeDataProfileStudent::getRequestDataOnGrade($this->grade);
    }


}
