<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestChangeDataProfileStudent extends Model
{
    public $timestamps = false;
    protected $fillable = [
        "name",
        "gender",
        "email",
        "password",
        "class_id",
        "nisn",
        "nis",
        "photo_profile",
        "phone_number",
        "no_absen"
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class);
    }
}
