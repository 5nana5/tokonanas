<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\UserMarketing;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userMarketings = UserMarketing::all();

        $customers = [
            [
                'name' => 'PT Maju Jaya Indonesia',
                'email' => 'info@majujaya.com',
                'phone' => '021-1234567',
                'address' => 'Jln. Gatot Subroto No. 100',
                'city' => 'Jakarta',
                'province' => 'DKI Jakarta',
                'postal_code' => '12210',
            ],
            [
                'name' => 'CV Teknologi Mandiri',
                'email' => 'contact@teknomandiri.co.id',
                'phone' => '022-2345678',
                'address' => 'Jln. Diponegoro No. 250',
                'city' => 'Bandung',
                'province' => 'Jawa Barat',
                'postal_code' => '40135',
            ],
            [
                'name' => 'Toko Elektronik Pusat',
                'email' => 'belanja@tokoelektron.id',
                'phone' => '031-3456789',
                'address' => 'Jln. Basuki Rahmat No. 500',
                'city' => 'Surabaya',
                'province' => 'Jawa Timur',
                'postal_code' => '60271',
            ],
            [
                'name' => 'UMKM Digital Solution',
                'email' => 'sales@umkmdigital.com',
                'phone' => '0274-4567890',
                'address' => 'Jln. Malioboro No. 123',
                'city' => 'Yogyakarta',
                'province' => 'DI Yogyakarta',
                'postal_code' => '55271',
            ],
            [
                'name' => 'Distributor Elektronik Medan',
                'email' => 'distributor@medan.com',
                'phone' => '061-5678901',
                'address' => 'Jln. Pemuda No. 789',
                'city' => 'Medan',
                'province' => 'Sumatera Utara',
                'postal_code' => '20111',
            ],
        ];

        foreach ($customers as $customer) {
            $customer['user_marketing_id'] = $userMarketings->random()->id;
            Customer::create($customer);
        }
    }
}
