<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserMarketingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('produk', ProdukController::class);
    Route::resource('customer', CustomerController::class);

    Route::get('/transaksi/export', [TransaksiController::class, 'export'])->name('transaksi.export');
    Route::resource('transaksi', TransaksiController::class);

    Route::resource('user_marketings', UserMarketingController::class);

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';