@extends('layouts.admin')

@section('page_title', 'Detail Transaksi')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0"><i class="fas fa-receipt"></i> Detail Transaksi</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">User Marketing</h6>
                                <p class="fs-5">{{ $transaksi->userMarketing->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Customer</h6>
                                <p class="fs-5">{{ $transaksi->customer->name }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Produk</h6>
                                <p class="fs-5">{{ $transaksi->product->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Jumlah</h6>
                                <p class="fs-5">{{ $transaksi->quantity }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Total Harga</h6>
                                <p class="fs-5">Rp {{ number_format($transaksi->total_price, 2, ',', '.') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Status Pembayaran</h6>
                                <p class="fs-5">
                                    @if ($transaksi->payment_status == 'paid')
                                        <span class="badge bg-success">Lunas</span>
                                    @elseif ($transaksi->payment_status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Tanggal Transaksi</h6>
                                <p class="fs-5">{{ $transaksi->transaction_date->format('d M Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Dibuat</h6>
                                <p class="fs-5">{{ $transaksi->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        @if ($transaksi->notes)
                            <div class="mb-3">
                                <h6 class="text-muted">Catatan</h6>
                                <p class="fs-5">{{ $transaksi->notes }}</p>
                            </div>
                        @endif

                        <div class="d-flex gap-2">
                            <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('transaksi.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
