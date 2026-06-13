@extends('layouts.admin')

@section('page_title', 'Detail Produk')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0"><i class="fas fa-cube"></i> Detail Produk</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Nama Produk</h6>
                                <p class="fs-5">{{ $produk->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">User Marketing</h6>
                                <p class="fs-5">{{ $produk->userMarketing->name }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Harga</h6>
                                <p class="fs-5">Rp {{ number_format($produk->price, 2, ',', '.') }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Stok</h6>
                                <p class="fs-5">{{ $produk->stock }} unit</p>
                            </div>
                        </div>

                        @if ($produk->description)
                            <div class="mb-3">
                                <h6 class="text-muted">Deskripsi</h6>
                                <p class="fs-5">{{ $produk->description }}</p>
                            </div>
                        @endif

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Status</h6>
                                <p>
                                    @if ($produk->status == 'active')
                                        <span class="badge bg-success fs-6">Aktif</span>
                                    @else
                                        <span class="badge bg-danger fs-6">Tidak Aktif</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Tanggal Dibuat</h6>
                                <p class="fs-5">{{ $produk->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('produk.edit', $produk->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
