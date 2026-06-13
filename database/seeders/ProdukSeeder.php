<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\UserMarketing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userMarketings = UserMarketing::all();

        $produks = [
            [
                'name' => 'Laptop Gaming ASUS ROG',
                'description' => 'Laptop gaming dengan spesifikasi tinggi untuk performa maksimal',
                'price' => 15000000,
                'stock' => 10,
                'status' => 'active',
            ],
            [
                'name' => 'Smartphone Samsung Galaxy S24',
                'description' => 'Smartphone flagship terbaru dengan kamera canggih',
                'price' => 12000000,
                'stock' => 25,
                'status' => 'active',
            ],
            [
                'name' => 'Tablet iPad Pro 12.9"',
                'description' => 'Tablet premium untuk produktivitas dan kreativitas',
                'price' => 8000000,
                'stock' => 15,
                'status' => 'active',
            ],
            [
                'name' => 'Smartwatch Apple Watch Series 9',
                'description' => 'Smartwatch dengan fitur kesehatan dan fitness tracking',
                'price' => 6000000,
                'stock' => 20,
                'status' => 'active',
            ],
            [
                'name' => 'Headphones Wireless Sony WH-1000XM5',
                'description' => 'Headphones dengan noise cancellation terbaik di kelasnya',
                'price' => 3500000,
                'stock' => 30,
                'status' => 'active',
            ],
            [
                'name' => 'USB-C Hub 7 in 1',
                'description' => 'Hub connector multifungsi untuk produktivitas maksimal',
                'price' => 500000,
                'stock' => 50,
                'status' => 'active',
            ],
        ];

        foreach ($produks as $produk) {
            $produk['user_marketing_id'] = $userMarketings->random()->id;
            Produk::create($produk);
        }
    }
}
