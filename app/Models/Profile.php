<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use function implode;

class Profile extends Model
{
    protected $with = ["user", "class"];
    protected $fillable = [
        "nisn",
        "nis",
        "photo_profile",
        "no_absen"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->morphOne(ClassRelationship::class, "referensi");
    }

//    polymorphic relationship
    public function phone()
    {
        return $this->morphOne(Phone::class, "phoneable");
    }

    public function request_change_profile_data()
    {
        return $this->hasOne(RequestChangeDataProfileStudent::class);
    }

    public function student_payment()
    {
        return $this->hasMany(StudentPayment::class);
    }

    public static function data_siswa($grade, $definitely=false)
    {
        return Profile::whereHas("class", function($q) use ($grade) {
            $q->whereHas("class", function($q) use ($grade) {
                $q->where("class", "like", "%{$grade}%");
            });
        });
    }

    public static function searchWithName($grade, $email)
    {
//       method wherehas, parameter pertama berisi nama method relasi terhadap table lain, & parameter kedua berisi callback function yang didalamnya berisi aksi yang akan dijalankan oleh si relasi tersebut.
//      Jadi panggil method data siswa dimana dia mempunyai relasi user, lalu user tersebut mencari mana email yang cocok dengan parameter $email
        return self::data_siswa($grade)->whereHas("user", function($q) use ($email) {
            $q->where("name", "like", "%$email%");
        })->get();
    }

    public static function searchWithEmail($grade, $email)
    {
        return self::data_siswa($grade)->whereHas("user", function($q) use ($email) {
            $q->where("email", "like", "%$email%");
        })->get();
    }

    public static function searchWithClass($grade, $class)
    {
//        masuk ke relasi class dari model profile, lali cari class_id yang value nya seperti result dari class like dari model school class
        $result = Profile::whereHas("class", function($q) use ($class, $grade) {
           $q->whereIn("class_id",
               SchoolClass::where("class", "like", "%$grade%")
                          ->where("class", "like", "%$class%")
                          ->get()
                          ->map(fn($q)=>$q->id));
        })->get();
//        $result = SchoolClass::where("class", "like", "%$grade%")
//                             ->where("class", "like", "%$class%")
//                             ->get()
//                             ->map(fn($q) => $q->class_relationship()
//                                               ->where("referensi_type", "App\Models\Profile")
//                                               ->get()
//                                               ->map(fn($q2) => $q2->posession));
        return $result;
    }

    public static function rules_student($user = null, $photo_profile = true, $password = false): array
    {
        $rules = [
            "name" => "required|min:4|max:50|string",
            "gender" => "required|string|in:Laki-Laki,Perempuan",
            "email" => "required|email|min:6|unique:users,email,$user?->id",
            "class_id" => "required|in:" . implode(",", SchoolClass::get()->map(fn($data) => $data->id)->toArray()),
            "nis" => "unique:profiles,NIS,{$user?->profile?->id}|required|numeric",
            "nisn" => "unique:profiles,NISN,{$user?->profile?->id}|required|numeric",
            "phone_number" => "required|numeric|unique:phones,phone_number,{$user?->profile?->phone->id}",
            "no_absen" => "required|numeric|min:1",
        ];

        if($photo_profile)
        {
            $rules["photo_profile"] = "image|mimes:jpg,png,jpeg|max:2048";
        }
        if($password)
        {
            $rules["password"] = "required|string|min:6";
        }
        return $rules;
    }

    public static function unique_no_absen($class_id, $no_absen): bool
    {
        return (bool)ClassRelationship::where([
            "class_id" => $class_id,
            "referensi_type" => "App\Models\Profile"
        ])->get()
          ->filter(fn($query) => $query?->posession?->no_absen == $no_absen)
          ->count();
    }

    public static function messages_student(): array
    {
        return [
            "name.required" => "Kolom Nama wajib diisi!",
            "name.min" => "Minimal 4 huruf!",
            "name.max" => "Maximal 50 huruf!",
            "name.string" => "Kolom Name wajib berbentuk string, tidak yang lain!",
            "password.required" => "Kolom Password wajib diisi!",
            "password.string" => "Kolom Password harus berbentuk string/kata!",
            "password.min" => "Minimal 6 huruf!",
            "photo_profile.image" => "File Yang di-upload Wajib berbentuk gambar!",
            "photo_profile.mimes" => "Extensi foto wajib jpg, png atau jpeg",
            "photo_profile.max" => "Maximal ukuran foto adalah 2MB",
            "gender.required" => "Wajib memilih jenis kelamin!",
            "gender.string" => "Pilihan jenis kelamin wajib berbentuk string!",
            "gender.in" => "Hanya ada 2 pilihan 2 jenis kelamin! Laki - Laki atau Perempuan",
            "email.required" => "Wajib mengisi kolom email!",
            "email.email" => "Format tulisan tidak berbentuk email!",
            "email.unique" => "Email tersebut sudah digunakan orang lain!",
            "class_id.required" => "Wajib memilih 1 kelas!",
            "class_id.in" => "Pilihan yang dipilah tidak ada didalam daftar kelas di sekolah!",
            "nis.required" => "Wajib mengisi kolom NIS",
            "nis.unique" => "NIS yang dimasukan sudah digunakan orang lain!",
            "nis.numeric" => "Hanya bisa memasukan angka didalam kolom NIS!",
            "nisn.required" => "Wajib mengisi kolom NISN",
            "nisn.unique" => "NISN yang dimasukan sudah digunakan orang lain!",
            "nisn.numeric" => "Hanya bisa memasukan angka didalam kolom BUSB!",
            "phone_number.required" => "Masukan No. Telepon WA di kolom Nomor HP/WA!",
            "phone_number.unique" => "No telepon sudah digunakan orang lain!",
            "phone_number.numeric" => "Hanya boleh ada angka pada kolom Nomor HP/WA!",
            "no_absen.required" => "Kolom No. Absen wajib diisi!",
            "no_absen.numeric" => "Kolom No. Absen hanya boleh diisi dengan angka",
            "no_absen.min" => "Kolom No. Absen tidak boleh bernilai negatif!",
        ];
    }

    public static function updateProfile($data, $user)
    {
        try
        {
//            $user->update(self::toArrayM($data, ["name", "gender", "email"]));
            $user->update($data->toArray());
//            $user->profile->update(self::toArrayM($data, ["photo_profile", "nis", "nisn", "no_absen"]));
            $user->profile->update($data->toArray());

            $user->profile->class()->update(self::toArrayM($data, ["class_id"]));
            $user->profile->phone()->update(self::toArrayM($data, ["phone_number"]));
        }
        catch(\Exception $err)
        {
           abort(403, "Terdapat Error saat meng-update Data! Please Reload The Page!");
        }
    }

    protected static function toArrayM($data, $key): array
    {
        return $data->only(...$key)->toArray();
    }

    public static function status_pembayaran()
    {
        return auth()?->user()?->profile?->student_payment()?->latest()?->first()?->status;
    }
}
