<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMarketing extends Model
{
    protected $fillable = [
        'name',
        'email',
        'phone',
        'position',
        'address',
        'city',
        'province',
        'postal_code',
        'bio',
        'status',
    ];

    public function produks()
    {
        return $this->hasMany(Produk::class);
    }

    public function customers()
    {
        return $this->hasMany(Customer::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class);
    }
}
