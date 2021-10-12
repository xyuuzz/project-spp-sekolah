<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportFile extends Model
{
    protected $fillable = ["file"];
    public $timestamps = false;

    public function report()
    {
        return $this->belongsTo(TeacherReport::class);
    }
}
