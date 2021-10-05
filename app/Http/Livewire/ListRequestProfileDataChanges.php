<?php

namespace App\Http\Livewire;

use App\Models\{RequestChangeDataProfileStudent, SchoolClass, Profile};
use Livewire\Component;
use function dd;

class ListRequestProfileDataChanges extends Component
{
    public $list_profile_request;
    public $grade, $name, $gender, $email, $password, $no_wa, $class, $no_absen, $nis, $nisn, $phone_number;
//$n_name, $n_gender, $n_email, $n_password, $n_no_wa, $n_class, $n_no_absen, $n_nis, $n_nisn, $name, $gender, $email, $password, $no_wa, $class, $no_absen, $nis, $nisn

    protected $listeners = [
        "postData" => "dataSiswa",
    ];

    public function dataSiswa($data)
    {
        $this->list_profile_request = $data->map(fn($q) => $q->request_change_profile_data);
    }
//
//    public function mount($grade)
//    {
//        $this->grade = $grade;
//    }

    public function render()
    {
        return view('livewire.list-request-profile-data-changes')
            ->with(["list_profile_request" => $this->list_profile_request]);
    }

    public function mantab($id)
    {
//        $profile = Profile::find($id);
//        $this->name = $profile->user->name;
//        $this->gender = $profile->user->gender;
//        $this->email = $profile->user->email;
//        $this->password = $profile->user->password;
//        $this->no_wa = $profile->phone->phone_number;
//        $this->class = $profile->class->class->class;
//        $this->no_absen = $profile->no_absen;
//        $this->nisn = $profile->nisn;
//        $this->nis = $profile->nis;
//        $this->phone_number = $profile->phone->phone_number;
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
        $this->list_profile_request = RequestChangeDataProfileStudent::with("profile", "class")->whereHas("profile", function($query) use ($grade) {
            $query->with("phone")->whereHas("class", function($query2) use ($grade) {
                $query2->whereHas("class", function($query3) use ($grade) {
                    $query3->where("class", $grade);
                });
            });
        })->get();
        $this->grade = $grade;
    }


}
