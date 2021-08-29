<?php

namespace App\Models;

use App\Models\User;
use App\Models\Price;
use Illuminate\Database\Eloquent\Model;

class StudentPayment extends Model
{
    protected $fillable = [
        "price_id",
        "month",
        "status",
        "slug"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
