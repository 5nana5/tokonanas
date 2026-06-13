@extends('layouts.admin')

@section('page_title', 'Daftar Transaksi')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-receipt"></i>
                    Transactions List
                </h3>
                <div class="card-tools d-flex align-items-center">
                    <a href="{{ route('transaksi.create') }}" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-plus"></i> Tambah Transaksi
                    </a>

                    <form action="{{ route('transaksi.export') }}" method="GET" class="form-inline d-flex">
                        <div class="input-group input-group-sm mr-2">
                            <input type="date" name="start_date" class="form-control" value="{{ request('start_date') }}" placeholder="Start date">
                        </div>
                        <div class="input-group input-group-sm mr-2">
                            <input type="date" name="end_date" class="form-control" value="{{ request('end_date') }}" placeholder="End date">
                        </div>
                        <button type="submit" class="btn btn-success btn-sm me-2" title="Export Periode">
                            <i class="fas fa-file-excel"></i> Export Periode
                        </button>
                        <a href="{{ route('transaksi.export') }}" class="btn btn-outline-success btn-sm" title="Export Semua">
                            <i class="fas fa-file-excel"></i> Export Semua
                        </a>
                    </form>
                </div>
            </div>

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
                    <i class="fas fa-check-circle"></i> {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card-body">
                @if ($transaksis->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User Marketing</th>
                                    <th>Customer</th>
                                    <th>Produk</th>
                                    <th>Jumlah</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Tanggal</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($transaksis as $index => $transaksi)
                                    <tr>
                                        <td>{{ ($transaksis->currentPage() - 1) * $transaksis->perPage() + $index + 1 }}</td>
                                        <td>{{ $transaksi->userMarketing->name }}</td>
                                        <td>{{ $transaksi->customer->name }}</td>
                                        <td>{{ Str::limit($transaksi->product->name, 15) }}</td>
                                        <td>{{ $transaksi->quantity }}</td>
                                        <td><small class="badge badge-info">Rp {{ number_format($transaksi->total_price, 0, ',', '.') }}</small></td>
                                        <td>
                                            @if ($transaksi->payment_status == 'paid')
                                                <span class="badge badge-success">Lunas</span>
                                            @elseif ($transaksi->payment_status == 'pending')
                                                <span class="badge badge-warning">Pending</span>
                                            @else
                                                <span class="badge badge-danger">Batal</span>
                                            @endif
                                        </td>
                                        <td><small>{{ $transaksi->transaction_date->format('d M Y') }}</small></td>
                                        <td>
                                            <a href="{{ route('transaksi.show', $transaksi->id) }}" class="btn btn-info btn-xs" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('transaksi.edit', $transaksi->id) }}" class="btn btn-warning btn-xs" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('transaksi.destroy', $transaksi->id) }}" method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-xs" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" title="Hapus">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-3">
                        {{ $transaksis->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> No transactions yet
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
