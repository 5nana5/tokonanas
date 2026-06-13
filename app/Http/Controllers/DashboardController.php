<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\UserMarketing;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $productsCount = Produk::count();
        $customersCount = Customer::count();
        $transaksisCount = Transaksi::count();
        $userMarketingsCount = UserMarketing::count();
        $totalRevenue = Transaksi::sum('total_price');

        $paymentStatusCounts = Transaksi::select('payment_status', DB::raw('COUNT(*) as count'))
            ->groupBy('payment_status')
            ->pluck('count', 'payment_status')
            ->toArray();

        $revenueTrendLabels = [];
        $revenueTrendData = [];
        for ($i = 6; $i >= 0; $i--) {
            $date = now()->subDays($i);
            $revenueTrendLabels[] = $date->format('d/m');
            $revenueTrendData[] = (int) Transaksi::whereDate('created_at', $date)->sum('total_price');
        }

        $topProducts = Transaksi::with('product')
            ->select('product_id', DB::raw('COUNT(*) as sales'))
            ->groupBy('product_id')
            ->orderByDesc('sales')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => optional($item->product)->name ?: 'Produk Tidak Ditemukan',
                    'sales' => $item->sales,
                ];
            });

        $userMarketingPerformance = Transaksi::with('userMarketing')
            ->select('user_marketing_id', DB::raw('COUNT(*) as transactions'))
            ->groupBy('user_marketing_id')
            ->orderByDesc('transactions')
            ->limit(5)
            ->get()
            ->map(function ($item) {
                return [
                    'name' => optional($item->userMarketing)->name ?: 'User Marketing Tidak Ditemukan',
                    'transactions' => $item->transactions,
                ];
            });

        return view('dashboard', compact(
            'productsCount',
            'customersCount',
            'transaksisCount',
            'userMarketingsCount',
            'totalRevenue',
            'paymentStatusCounts',
            'revenueTrendLabels',
            'revenueTrendData',
            'topProducts',
            'userMarketingPerformance'
        ));
    }
}
