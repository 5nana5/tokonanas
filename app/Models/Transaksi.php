<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    protected $table = 'transactions';

    protected $fillable = [
        'user_marketing_id',
        'customer_id',
        'product_id',
        'quantity',
        'total_price',
        'payment_status',
        'transaction_date',
        'notes',
    ];

    protected $casts = [
        'transaction_date' => 'datetime',
    ];

    public function userMarketing()
    {
        return $this->belongsTo(UserMarketing::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function product()
    {
        return $this->belongsTo(Produk::class);
    }
}
