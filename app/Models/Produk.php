<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'user_marketing_id',
        'name',
        'description',
        'price',
        'stock',
        'status',
    ];

    public function userMarketing()
    {
        return $this->belongsTo(UserMarketing::class);
    }

    public function transaksis()
    {
        return $this->hasMany(Transaksi::class, 'product_id');
    }
}
