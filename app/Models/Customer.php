<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'user_marketing_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'province',
        'postal_code',
    ];

    public function userMarketing()
    {
        return $this->belongsTo(UserMarketing::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
