<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChangeDataProfileStudent extends Model
{
    public $timestamps = false;
    protected $fillable = ["name", "gender", "email", "password", "class_id", "nisn", "nis", "photo_profile", "number_phone"];

    public function user()
    {
        $this->belongsTo(User::class);
    }
}
