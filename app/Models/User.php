<?php

namespace App\Models;

use App\Models\{Profile, SchoolClass, StudentPayment};
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

// ! jika foreign key berbeda dengan nama table, maka tuliskan di has nya bukan di belongsto nya

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        "name",
        'email',
        'password',
        "slug",
        "gender",
        "role"
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class, "user_id");
    }

//    polymorphic relationship
    public function class_teacher()
    {
//        return $this->belongsToMany(SchoolClass::class, "class_teacher", "user_id", "class_id");
        return $this->morphOne(ClassRelationship::class, "referensi");
    }

//    polymorphic relationship
    public function phone()
    {
        return $this->morphOne(Phone::class, "phoneable");
    }

    public static function data_guru()
    {
        return self::where("role", "teacher")
                   ->with("class_teacher");
    }

    public static function searchWithTeacherClass($class)
    {
        return self::data_guru()->whereHas("class_teacher", function($q) use ($class) {
            $q->where("class", "like", "%$class%");
        })->get();
    }

    public static function rules_teacher($slug)
    {
        return [
            "name" => "required|string|min:4|max:30",
            "gender" => "required|string|in:Laki-Laki,Perempuan",
            "email" => "required|email|min:7",
            "class_teacher" => "required|numeric|in:" . implode("," , self::arr_id_not_teacher_class($slug))
        ];
    }

    public static function messages_teacher()
    {
        return [
            "name.required" => "Kolom Nama harus diisi!",
            "name.string" => "Kolom Nama harus memiliki tipe data string",
            "name.min" => "Minimal panjang kata adalah 4",
            "name.max" => "Maximal panjang kata adalah 30",
            "gender.required" => "Pilihan Jenis Kelamin harus diisi!",
            "gender.string" => "Pilihan Jenis Kelamin harus bertipe data string",
            "gender.in" => "Jenis Kelamin tidak Normal!",
            "email.required" => "Kolom Email wajib diisi!",
            "email.email" => "Mohon masukan Format Email dengan benar",
            "email.min" => "Minimal Panjang Email adalah 7 kata",
            "class_teacher.required" => "Pilihan Wali Kelas Wajib diisi bagi Guru!",
            "class_teacher.numeric" => "Tidak ada pilihan seperti itu!",
            "class_teacher.in" => "ID Kelas Tersebut Tidak Valid!"
        ];
    }

    //    mengembalikan array yang berisi class id yang belum mempunyai wali kelas.
    protected static function arr_id_not_teacher_class($slug)
    {
        $user = self::whereNotIn( "id", [User::firstWhere("slug", $slug)->id] )
                    ->where("role", "teacher")
                    ->get()
                    ->map(fn($data) => $data->class_teacher()->first()->id )
                    ->toArray();

        return SchoolClass::whereNotIn("id", $user)
                          ->get()
                          ->map(fn($data) => $data->id)
                          ->toArray();
    }
}
