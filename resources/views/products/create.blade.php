@extends('layouts.admin')

@section('page_title', 'Tambah Produk')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-plus-circle"></i> Tambah Produk</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible m-3" role="alert">
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Validasi Gagal!</h5>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <form action="{{ route('produk.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="user_marketing_id">User Marketing <span class="text-danger">*</span></label>
                        <select name="user_marketing_id" id="user_marketing_id" class="form-control @error('user_marketing_id') is-invalid @enderror" required>
                            <option value="">-- Pilih User Marketing --</option>
                            @foreach($userMarketings as $um)
                                <option value="{{ $um->id }}" {{ old('user_marketing_id') == $um->id ? 'selected' : '' }}>{{ $um->name }}</option>
                            @endforeach
                        </select>
                        @error('user_marketing_id') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Nama Produk <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" placeholder="Masukkan nama produk" required>
                        @error('name') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Deskripsi</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" placeholder="Masukkan deskripsi produk">{{ old('description') }}</textarea>
                        @error('description') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="price">Harga <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" step="0.01" min="0" placeholder="0" required>
                                @error('price') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="stock">Stok <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('stock') is-invalid @enderror" id="stock" name="stock" value="{{ old('stock') }}" min="0" placeholder="0" required>
                                @error('stock') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <label for="status">Status <span class="text-danger">*</span></label>
                        <select class="form-control @error('status') is-invalid @enderror" id="status" name="status" required>
                            <option value="">-- Pilih Status --</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                        </select>
                        @error('status') <span class="text-danger text-sm">{{ $message }}</span> @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Simpan
                        </button>
                        <a href="{{ route('produk.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
