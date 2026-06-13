<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\UserMarketing;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'productsCount' => Produk::count(),
            'customersCount' => Customer::count(),
            'transaksisCount' => Transaksi::count(),
            'userMarketingsCount' => UserMarketing::count(),
        ]);
    }
}
