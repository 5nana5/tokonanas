<?php

namespace Database\Seeders;

use App\Models\Transaksi;
use App\Models\UserMarketing;
use App\Models\Customer;
use App\Models\Produk;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransaksiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userMarketings = UserMarketing::all();
        $customers = Customer::all();
        $produks = Produk::all();

        $transaksis = [
            [
                'quantity' => 2,
                'payment_status' => 'paid',
                'transaction_date' => now()->subDays(5),
                'notes' => 'Pembayaran tepat waktu',
            ],
            [
                'quantity' => 1,
                'payment_status' => 'paid',
                'transaction_date' => now()->subDays(3),
                'notes' => 'Pengiriman express',
            ],
            [
                'quantity' => 3,
                'payment_status' => 'pending',
                'transaction_date' => now()->subDays(1),
                'notes' => 'Menunggu konfirmasi pembayaran',
            ],
            [
                'quantity' => 1,
                'payment_status' => 'paid',
                'transaction_date' => now(),
                'notes' => null,
            ],
            [
                'quantity' => 2,
                'payment_status' => 'paid',
                'transaction_date' => now()->subDays(10),
                'notes' => 'Transaksi dengan diskon',
            ],
            [
                'quantity' => 1,
                'payment_status' => 'cancelled',
                'transaction_date' => now()->subDays(7),
                'notes' => 'Pembeli membatalkan pesanan',
            ],
        ];

        foreach ($transaksis as $transaksi) {
            $produk = $produks->random();
            $transaksi['user_marketing_id'] = $userMarketings->random()->id;
            $transaksi['customer_id'] = $customers->random()->id;
            $transaksi['product_id'] = $produk->id;
            $transaksi['total_price'] = $produk->price * $transaksi['quantity'];
            Transaksi::create($transaksi);
        }
    }
}
