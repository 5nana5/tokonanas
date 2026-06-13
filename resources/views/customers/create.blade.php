@extends('layouts.admin')

@section('page_title', 'Tambah Customer')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Tambah Customer</h4>
                    </div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <h5>Validasi Gagal!</h5>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <form action="{{ route('customer.store') }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="user_marketing_id" class="form-label">User Marketing <span class="text-danger">*</span></label>
                                <select class="form-select @error('user_marketing_id') is-invalid @enderror" id="user_marketing_id" name="user_marketing_id" required>
                                    <option value="">Pilih User Marketing</option>
                                    @foreach ($userMarketings as $userMarketing)
                                        <option value="{{ $userMarketing->id }}" {{ old('user_marketing_id') == $userMarketing->id ? 'selected' : '' }}>{{ $userMarketing->name }}</option>
                                    @endforeach
                                </select>
                                @error('user_marketing_id') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="phone" class="form-label">Telepon <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3" required>{{ old('address') }}</textarea>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">Kota <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
                                        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="province" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province') }}" required>
                                        @error('province') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="postal_code" class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code') }}" required>
                                @error('postal_code') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="{{ route('customer.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
