@extends('layouts.admin')

@section('page_title', 'Detail Customer')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0"><i class="fas fa-user"></i> Detail Customer</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Nama</h6>
                                <p class="fs-5">{{ $customer->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Email</h6>
                                <p class="fs-5">{{ $customer->email }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Telepon</h6>
                                <p class="fs-5">{{ $customer->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">User Marketing</h6>
                                <p class="fs-5">{{ $customer->userMarketing->name }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Alamat</h6>
                            <p class="fs-5">{{ $customer->address }}, {{ $customer->city }}, {{ $customer->province }}, {{ $customer->postal_code }}</p>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('customer.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
