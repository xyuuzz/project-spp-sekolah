<?php

namespace App\Models;

use App\Models\User;
use App\Models\Price;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    protected $fillable = [
        "no_rek",
        "struk_transfer",
        "status"
    ];

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
