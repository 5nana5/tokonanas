<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail User Marketing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-info text-white">
                        <h4 class="mb-0"><i class="fas fa-user-tie"></i> Detail User Marketing</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Nama</h6>
                                <p class="fs-5">{{ $userMarketing->name }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Email</h6>
                                <p class="fs-5">{{ $userMarketing->email }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Telepon</h6>
                                <p class="fs-5">{{ $userMarketing->phone }}</p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Posisi</h6>
                                <p class="fs-5">{{ $userMarketing->position }}</p>
                            </div>
                        </div>

                        <div class="mb-3">
                            <h6 class="text-muted">Alamat</h6>
                            <p class="fs-5">{{ $userMarketing->address }}</p>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <h6 class="text-muted">Kota</h6>
                                <p class="fs-5">{{ $userMarketing->city }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted">Provinsi</h6>
                                <p class="fs-5">{{ $userMarketing->province }}</p>
                            </div>
                            <div class="col-md-4">
                                <h6 class="text-muted">Kode Pos</h6>
                                <p class="fs-5">{{ $userMarketing->postal_code }}</p>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h6 class="text-muted">Status</h6>
                                <p>
                                    @if ($userMarketing->status == 'active')
                                        <span class="badge bg-success fs-6">Aktif</span>
                                    @else
                                        <span class="badge bg-danger fs-6">Tidak Aktif</span>
                                    @endif
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="text-muted">Tanggal Dibuat</h6>
                                <p class="fs-5">{{ $userMarketing->created_at->format('d M Y H:i') }}</p>
                            </div>
                        </div>

                        @if ($userMarketing->bio)
                            <div class="mb-3">
                                <h6 class="text-muted">Bio</h6>
                                <p class="fs-5">{{ $userMarketing->bio }}</p>
                            </div>
                        @endif

                        <div class="d-flex gap-2">
                            <a href="{{ route('user_marketings.edit', $userMarketing->id) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a href="{{ route('user_marketings.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
