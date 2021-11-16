<?php

namespace App\Models;

// use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SppTransaction extends Model
{
    protected $fillable = [
        "link_pembayaran",
        "amount",
        "pay_code",
        "status",
        "qr_code",
        "kadaluarsa"
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
