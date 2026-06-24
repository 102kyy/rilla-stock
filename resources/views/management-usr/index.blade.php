@extends('layouts.app')

@section('title', 'Manajemen User')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row align-items-center mb-2">
            <div class="col-12 col-md-5 mb-3 mb-md-0">
                <h1 class="page-title m-0" style="color: #6d4c41; font-weight: 600;">
                    <i class="ti ti-users me-2"></i> Manajemen Pegawai Rilla-Stock
                </h1>
                <div class="text-muted small mt-1">Daftarkan dan kelola hak akses pegawai tanpa fitur registrasi umum.</div>
            </div>
            
            <div class="col-12 col-md-7 d-flex justify-content-md-end align-items-center gap-2 flex-wrap">
                <button type="button" class="btn text-white d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal-pegawai" style="background-color: #ba9778; border-radius: 8px;">
                    <i class="ti ti-user-plus me-2"></i> Tambah Pegawai
                </button>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div><i class="ti ti-check me-2"></i></div>
                            <div>{{ session('success') }}</div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div><i class="ti ti-alert-triangle me-2"></i></div>
                            <div>{{ session('error') }}</div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif

                <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(186, 151, 120, 0.1);">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead style="background-color: #fffaf5;">
                                <tr>
                                    <th class="w-1">No</th>
                                    <th>Nama Pegawai</th>
                                    <th>Email Resmi</th>
                                    <th class="text-center">Role</th>
                                    <th class="w-1 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pegawais as $key => $pegawai)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="fw-bold" style="color: #8d6e63;">{{ $pegawai->name }}</td>
                                    <td class="text-muted">{{ $pegawai->email }}</td>
                                    <td class="text-center">
                                        @if($pegawai->role === 'admin')
                                            <span class="badge bg-amber-lt">Admin</span>
                                        @else
                                            <span class="badge bg-secondary-lt">Pegawai</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap justify-content-center">
                                            <button class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $pegawai->id }}">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete({{ $pegawai->id }}, '{{ $pegawai->name }}')">
                                                <i class="ti ti-trash"></i>
                                            </button>

                                            <form action="{{ route('user.destroy', $pegawai->id) }}" method="POST" id="delete-form-{{ $pegawai->id }}" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                {{-- MODAL EDIT --}}
                                <div class="modal modal-blur fade" id="modal-edit-{{ $pegawai->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content" style="border-radius: 15px;">
                                            <form action="{{ route('user.update', $pegawai->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header" style="background-color: #fffaf5;">
                                                    <h5 class="modal-title" style="color: #6d4c41;">Edit Akses Pegawai</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Nama Lengkap</label>
                                                        <input type="text" name="name" class="form-control" value="{{ $pegawai->name }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Email Resmi</label>
                                                        <input type="email" name="email" class="form-control" value="{{ $pegawai->email }}" required>
                                                    </div>

                                                    @include('management-usr.permission')

                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning ms-auto">Simpan Perubahan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted italic">Belum ada data pegawai terdaftar.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- MODAL TAMBAH PEGAWAI --}}
<div class="modal modal-blur fade" id="modal-pegawai" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background-color: #fffaf5;">
                    <h5 class="modal-title" style="color: #6d4c41;">Pegawai Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Budi Santoso" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email Pegawai</label>
                        <input type="email" name="email" class="form-control" placeholder="budi@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Role Akses</label>
                        <select name="role" class="form-select" required>
                            <option value="pegawai" selected>Pegawai (Stok & Laporan)</option>
                            <option value="admin">Admin (Akses Penuh)</option>
                        </select>
                    </div>
                    <div class="text-muted small italic">
                        *Password default awal akan di-generate otomatis oleh sistem dan dapat diubah berkala oleh pegawai.
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary ms-auto" style="background-color: #ba9778; border-color: #ba9778;">Daftarkan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Hapus Akses Pegawai?',
            text: "Yakin mau menghapus akun " + name + "? Pegawai tersebut tidak akan bisa login lagi ke Rilla-Stock.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#ba9778',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endpush
@endsection