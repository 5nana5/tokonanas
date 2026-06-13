@extends('layouts.admin')

@section('page_title', 'Dashboard')

@section('content')
@auth
<!-- Info boxes -->
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-info elevation-3"><i class="fas fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">User Marketing</span>
                <span class="info-box-number">{{ \App\Models\UserMarketing::count() }}</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-warning elevation-3"><i class="fas fa-box"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Produk</span>
                <span class="info-box-number">{{ \App\Models\Produk::count() }}</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-success elevation-3"><i class="fas fa-user-friends"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Customer</span>
                <span class="info-box-number">{{ \App\Models\Customer::count() }}</span>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon bg-danger elevation-3"><i class="fas fa-receipt"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Transaksi</span>
                <span class="info-box-number">{{ \App\Models\Transaksi::count() }}</span>
            </div>
        </div>
    </div>
</div>
<!-- /.row -->
@else
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card card-primary card-outline">
            <div class="card-header">
                <h3 class="card-title">Selamat datang di Tokonanas</h3>
            </div>
            <div class="card-body">
                <p class="card-text">Untuk masuk dan menggunakan semua fitur, silakan login terlebih dahulu.</p>
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endauth

<!-- Main row -->
<div class="row">
    <!-- Left col -->
    <div class="col-lg-8">
        <!-- Transaksi Terbaru -->
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="fas fa-receipt mr-1"></i>
                    Transaksi Terbaru
                </h3>
                <div class="card-tools">
                    <a href="{{ route('transaksi.index') }}" class="btn btn-tool btn-sm btn-primary">
                        <i class="fas fa-arrow-right"></i> Lihat Semua
                    </a>
                </div>
            </div>
            <div class="card-body table-responsive p-0">
                @if(\App\Models\Transaksi::count() > 0)
                    <table class="table table-striped table-valign-middle">
                        <thead>
                            <tr>
                                <th>Customer</th>
                                <th>Produk</th>
                                <th>User Marketing</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(\App\Models\Transaksi::with(['customer', 'product', 'userMarketing'])->latest()->take(5)->get() as $transaksi)
                                <tr>
                                    <td>{{ $transaksi->customer->name }}</td>
                                    <td>{{ Str::limit($transaksi->product->name, 20) }}</td>
                                    <td>{{ $transaksi->userMarketing->name }}</td>
                                    <td>
                                        <small class="badge badge-info">Rp {{ number_format($transaksi->total_price, 0, ',', '.') }}</small>
                                    </td>
                                    <td>
                                        @if($transaksi->payment_status == 'paid')
                                            <span class="badge bg-success">Lunas</span>
                                        @elseif($transaksi->payment_status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @else
                                            <span class="badge bg-danger">Batal</span>
                                        @endif
                                    </td>
                                    <td>{{ $transaksi->transaction_date->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info m-3">
                        <i class="fas fa-info-circle"></i> Belum ada data transaksi
                    </div>
                @endif
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-8 -->

    <!-- Right col -->
    <div class="col-lg-4">
        <!-- Produk Terbaru -->
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="fas fa-shopping-cart mr-1"></i>
                    Produk Terbaru
                </h3>
                <div class="card-tools">
                    <a href="{{ route('produk.index') }}" class="btn btn-tool btn-sm btn-primary">
                        <i class="fas fa-arrow-right"></i> Lihat
                    </a>
                </div>
            </div>
            <div class="card-body">
                @if(\App\Models\Produk::count() > 0)
                    <ul class="nav flex-column">
                        @foreach(\App\Models\Produk::latest()->take(5)->get() as $produk)
                            <li class="nav-item">
                                <a href="{{ route('produk.show', $produk->id) }}" class="nav-link">
                                    <i class="fas fa-box text-warning"></i>
                                    <p>
                                        {{ Str::limit($produk->name, 25) }}
                                        <span class="float-right text-muted text-sm">
                                            <small class="badge badge-light">{{ $produk->stock }}</small>
                                        </span>
                                    </p>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="text-center text-muted">Belum ada produk</p>
                @endif
            </div>
        </div>
        <!-- /.card -->

        <!-- Statistik Pembayaran Chart -->
        <div class="card">
            <div class="card-header border-0">
                <h3 class="card-title">
                    <i class="fas fa-chart-pie mr-1"></i>
                    Status Pembayaran
                </h3>
            </div>
            <div class="card-body" style="position: relative; height: 250px;">
                <canvas id="welcomePaymentStatusChart"></canvas>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col-md-4 -->
</div>
<!-- /.row -->
@endsection

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Payment Status Chart on Welcome page
    (function() {
        const ctx = document.getElementById('welcomePaymentStatusChart');
        if (!ctx) return;
        
        const paid = {{ \App\Models\Transaksi::where('payment_status', 'paid')->count() }};
        const pending = {{ \App\Models\Transaksi::where('payment_status', 'pending')->count() }};
        const cancelled = {{ \App\Models\Transaksi::where('payment_status', 'cancelled')->count() }};
        
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Lunas', 'Pending', 'Batal'],
                datasets: [{
                    data: [paid, pending, cancelled],
                    backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                    borderColor: '#fff',
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { position: 'bottom' }
                }
            }
        });
    })();
</script>
