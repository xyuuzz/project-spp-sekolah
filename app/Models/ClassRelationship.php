<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ClassRelationship extends Model
{
    protected $with = ["class"];
    protected $guarded = [];

    public function posession()
    {
        return $this->morphTo(__FUNCTION__, "referensi_type", "referensi_id");
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, "class_id");
    }
}
