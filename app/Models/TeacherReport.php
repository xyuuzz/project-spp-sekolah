<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeacherReport extends Model
{
    protected static function booted()
    {
        static::created(function ($teacher_report) {
            $teacher_report->is_seen = 0;
            $teacher_report->reply = "not yet";
        });
    }

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
