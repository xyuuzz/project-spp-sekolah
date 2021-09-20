<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = ["class", "biaya_spp"];

    public function register_link()
    {
        return $this->hasMany(LinkRegister::class, "class_id");
    }

//    public function profile()
//    {
//        return $this->hasMany(Profile::class, "class_id");
//    }

//    public function wali_kelas()
//    {
//        return $this->belongsToMany(User::class, "class_teacher", "class_id", "user_id");
//    }

//    return value : 7A,7B,7C,...
    public static function getAllClass()
    {
        return implode(",", SchoolClass::get()->map( fn($data) => $data->class)->toArray() );
    }

    public function class_relationship()
    {
        return $this->hasMany(ClassRelationship::class, "class_id");
    }

}
