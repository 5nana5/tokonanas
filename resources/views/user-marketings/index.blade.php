@extends('layouts.admin')

@section('page_title', 'Daftar User Marketing')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    <i class="fas fa-users"></i>
                    Daftar User Marketing
                </h3>
                <div class="card-tools">
                    <a href="{{ route('user_marketings.create') }}" class="btn btn-primary btn-sm">
                        <i class="fas fa-plus"></i> Tambah User Marketing
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
                @if ($userMarketings->count() > 0)
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Telepon</th>
                                    <th>Posisi</th>
                                    <th>Kota</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($userMarketings as $index => $userMarketing)
                                    <tr>
                                        <td>{{ ($userMarketings->currentPage() - 1) * $userMarketings->perPage() + $index + 1 }}</td>
                                        <td>{{ $userMarketing->name }}</td>
                                        <td><small>{{ $userMarketing->email }}</small></td>
                                        <td>{{ $userMarketing->phone }}</td>
                                        <td>{{ $userMarketing->position }}</td>
                                        <td>{{ $userMarketing->city }}</td>
                                        <td>
                                            @if ($userMarketing->status == 'active')
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-danger">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('user_marketings.show', $userMarketing->id) }}" class="btn btn-info btn-xs" title="Lihat">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('user_marketings.edit', $userMarketing->id) }}" class="btn btn-warning btn-xs" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('user_marketings.destroy', $userMarketing->id) }}" method="POST" style="display:inline;">
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
                        {{ $userMarketings->links('pagination::bootstrap-5') }}
                    </div>
                @else
                    <div class="alert alert-info text-center">
                        <i class="fas fa-info-circle"></i> Belum ada data User Marketing
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
