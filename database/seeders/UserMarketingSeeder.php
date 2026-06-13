<?php

namespace Database\Seeders;

use App\Models\UserMarketing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserMarketingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserMarketing::create([
            'name' => 'Ahmad Rizki',
            'email' => 'ahmad@example.com',
            'phone' => '08123456789',
            'position' => 'Sales Manager',
            'address' => 'Jln. Merdeka No. 123',
            'city' => 'Jakarta',
            'province' => 'DKI Jakarta',
            'postal_code' => '12345',
            'bio' => 'Profesional berpengalaman dalam penjualan',
            'status' => 'active',
        ]);

        UserMarketing::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@example.com',
            'phone' => '08234567890',
            'position' => 'Sales Executive',
            'address' => 'Jln. Sudirman No. 456',
            'city' => 'Bandung',
            'province' => 'Jawa Barat',
            'postal_code' => '40123',
            'bio' => 'Motivasi tinggi dalam mencapai target penjualan',
            'status' => 'active',
        ]);

        UserMarketing::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@example.com',
            'phone' => '08345678901',
            'position' => 'Sales Coordinator',
            'address' => 'Jln. Ahmad Yani No. 789',
            'city' => 'Surabaya',
            'province' => 'Jawa Timur',
            'postal_code' => '60123',
            'bio' => 'Tim player dengan komunikasi yang baik',
            'status' => 'active',
        ]);
    }
}
