<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LinkRegister extends Model
{
    protected $fillable = [
        "valid_form",
        "valid_until",
        "link",
        "role"
    ];

    protected $with = "class";

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, "class_id");
    }
}
