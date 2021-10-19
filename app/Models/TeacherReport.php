<?php

namespace App\Models;

use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class TeacherReport extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "title",
        "content",
        "is_seen",
        "reply",
        "about"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function report_files()
    {
        return $this->hasMany(ReportFile::class, "teacher_report_id");
    }
}
