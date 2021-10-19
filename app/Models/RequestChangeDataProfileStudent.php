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
        "no_absen",
        "status"
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public static function getRequestDataOnGrade($grade)
    {
        return RequestChangeDataProfileStudent::with("profile")
                                              ?->where("status", 0)
                                              ?->whereHas("profile", function($query) use ($grade) {
                                                  $query->with("phone")->whereHas("class", function($query2) use ($grade) {
                                                      $query2->whereHas("class", function($query3) use ($grade) {
                                                          $query3->where("class", $grade);
                                                      });
                                                  });
                                              })?->paginate(3);
    }
}
