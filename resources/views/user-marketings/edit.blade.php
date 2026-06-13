<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User Marketing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-warning text-dark">
                        <h4 class="mb-0"><i class="fas fa-edit"></i> Edit User Marketing</h4>
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

                        <form action="{{ route('user_marketings.update', $userMarketing->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="name" class="form-label">Nama <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $userMarketing->name) }}" required>
                                @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $userMarketing->email) }}" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="phone" class="form-label">Telepon <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone', $userMarketing->phone) }}" required>
                                        @error('phone') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="position" class="form-label">Posisi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('position') is-invalid @enderror" id="position" name="position" value="{{ old('position', $userMarketing->position) }}" required>
                                        @error('position') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Alamat <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address', $userMarketing->address) }}" required>
                                @error('address') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="city" class="form-label">Kota <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city', $userMarketing->city) }}" required>
                                        @error('city') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="province" class="form-label">Provinsi <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('province') is-invalid @enderror" id="province" name="province" value="{{ old('province', $userMarketing->province) }}" required>
                                        @error('province') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="postal_code" class="form-label">Kode Pos <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('postal_code') is-invalid @enderror" id="postal_code" name="postal_code" value="{{ old('postal_code', $userMarketing->postal_code) }}" required>
                                        @error('postal_code') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status <span class="text-danger">*</span></label>
                                        <select class="form-select @error('status') is-invalid @enderror" id="status" name="status" required>
                                            <option value="">Pilih Status</option>
                                            <option value="active" {{ old('status', $userMarketing->status) == 'active' ? 'selected' : '' }}>Aktif</option>
                                            <option value="inactive" {{ old('status', $userMarketing->status) == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                        </select>
                                        @error('status') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="bio" class="form-label">Bio</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="4">{{ old('bio', $userMarketing->bio) }}</textarea>
                                @error('bio') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning">
                                    <i class="fas fa-save"></i> Perbarui
                                </button>
                                <a href="{{ route('user_marketings.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
