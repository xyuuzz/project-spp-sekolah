<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\{SchoolClass, User};

class Profile extends Model
{
    protected $fillable = ["class_id", "nisn", "nis", "photo_profile", "number_phone", "slug"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, "class_id");
    }

    public static function data_siswa($grade)
    {
//        cari field class yg sama dengan value parameter, lalu dapatkan semua, lakukan map & setiap el ambil id nya, lalu ubah value dari hasil map menjadi array.
        $class = SchoolClass::where("class", "like", "%{$grade}%")
                            ->get()
                            ->map(fn($data) => $data->id)
                            ->toArray();

//        pilih value field class_id yang sama seperti salah satu el array $class
        return self::whereIn("class_id", $class)
                   ->with("user", "class");
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
        return self::data_siswa($grade)->whereHas("class", function($q) use ($class) {
            $q->where("class", "like", "%$class%");
        })->get();
    }

    public static function rules_student($user): array
    {
        return [
            "name" => "required|min:4|max:50|string",
            "photo" => "nullable|image|mimes:jpg,png,jpeg|max:2048",
            "gender" => "required|string|in:Laki-Laki,Perempuan",
            "email" => "required|email|unique:users,email,$user->id",
            "class" => "required|in:" . implode(",", SchoolClass::get()->map(fn($data) => $data->class)->toArray()),
            "nis" => "unique:profiles,NIS,{$user->profile->id}|required|numeric",
            "nisn" => "unique:profiles,NISN,{$user->profile->id}|required|numeric",
            "number_phone" => "unique:profiles,number_phone,{$user->profile->id}|required|numeric",
        ];
    }

    public static function messages_student(): array
    {
        return [
            "name.required" => "Kolom Nama wajib diisi!",
            "name.min" => "Minimal 4 huruf!",
            "name.max" => "Maximal 50 huruf!",
            "name.string" => "Kolom Name wajib berbentuk string, tidak yang lain!",
            "photo.image" => "Wajib berbentuk gambar!",
            "photo.mimes" => "Extensi foto wajib jpg, png atau jpeg",
            "photo.max" => "Maximal ukuran foto adalah 2MB",
            "gender.required" => "Wajib memilih jenis kelamin!",
            "gender.string" => "Pilihan jenis kelamin wajib berbentuk string!",
            "gender.in" => "Hanya ada 2 pilihan 2 jenis kelamin! Laki - Laki atau Perempuan",
            "email.required" => "Wajib mengisi kolom email!",
            "email.email" => "Format tulisan tidak berbentuk email!",
            "email.unique" => "Email tersebut sudah digunakan orang lain!",
            "class.required" => "Wajib memilih 1 kelas!",
            "class.in" => "Pilihan yang dipilah tidak ada didalam daftar kelas di sekolah!",
            "nis.required" => "Wajib mengisi kolom NIS",
            "nis.unique" => "NIS yang dimasukan sudah digunakan orang lain!",
            "nis.numeric" => "Hanya bisa memasukan angka didalam kolom ini!",
            "nisn.required" => "Wajib mengisi kolom NISN",
            "nisn.unique" => "NISN yang dimasukan sudah digunakan orang lain!",
            "nisn.numeric" => "Hanya bisa memasukan angka didalam kolom ini!",
            "number_phone.required" => "Wajib memasukan no telepon yang bisa di WA!",
            "number_phone.unique" => "No telepon sudah digunakan orang lain!",
            "number_phone.numeric" => "Hanya boleh ada angka pada kolom ini!"
        ];
    }

    public static function updateProfile($var, $user, $photo_name)
    {
        try
        {
            $user->update([
                "name" => $var["name"],
                "gender" => $var["gender"],
                "email" => $var["email"]
            ]);

            $user->profile->update([
                "photo_profile" => $photo_name,
                "nis" => $var["nis"],
                "nisn" => $var["nisn"],
                "class_id" => SchoolClass::firstWhere("class", $var["class"])->id,
                "number_phone" => $var["number_phone"]
            ]);
        }
        catch(\Exception $err)
        {
           abort(403, "Get Error While Update Data! Please Reload The Page!");
        }
    }
}
