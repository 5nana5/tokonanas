@extends('layouts.admin')

@section('page_title', 'Daftar Customer')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-user-friends"></i>
                    Daftar Customer
                </h3>
                <div class="card-tools">
                    <a href="{{ route('customer.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah Customer
                    </a>
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
                @if ($customers->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Kota</th>
                                    <th>User Marketing</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $index => $customer)
                                    <tr>
                                        <td>{{ ($customers->currentPage() - 1) * $customers->perPage() + $index + 1 }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td><small>{{ $customer->email }}</small></td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->city }}</td>
                                        <td>{{ $customer->userMarketing->name }}</td>
                                        <td>
                                            <a href="{{ route('customer.show', $customer->id) }}" class="btn btn-info btn-xs" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning btn-xs" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('customer.destroy', $customer->id) }}" method="POST" style="display:inline;">
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
                        {{ $customers->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Belum ada data Customer
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
