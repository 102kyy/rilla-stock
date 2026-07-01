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
                {{-- Alert Error Validation --}}
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <div class="d-flex">
                            <div><i class="ti ti-alert-triangle me-2"></i></div>
                            <div>
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>
                @endif

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
                                    <td class="text-center">
                                        <!-- DROPDOWN AKSI -->
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Pilih Aksi
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end">
                                                {{-- MENU DETAIL --}}
                                                <li>
                                                    <button type="button" class="dropdown-item btn-detail" data-id="{{ $pegawai->id }}">
                                                        <i class="ti ti-eye me-2 text-info"></i> Lihat Detail
                                                    </button>
                                                </li>
                                                
                                                {{-- MENU EDIT --}}
                                                <li>
                                                    <button type="button" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $pegawai->id }}">
                                                        <i class="ti ti-edit me-2 text-warning"></i> Edit Pegawai
                                                    </button>
                                                </li>
                                                
                                                {{-- MENU RESET PASSWORD (PANGGIL JS SWAL) --}}
                                                <li>
                                                    <button type="button" class="dropdown-item" onclick="confirmResetPassword({{ $pegawai->id }}, '{{ $pegawai->name }}')">
                                                        <i class="ti ti-refresh me-2 text-orange"></i> Reset Password
                                                    </button>
                                                    <form method="POST" action="{{ route('admin.users.reset-password', $pegawai->id) }}" id="reset-form-{{ $pegawai->id }}" class="d-none">
                                                        @csrf
                                                        @method('PUT')
                                                    </form>
                                                </li>
                                                
                                                {{-- MENU HAPUS --}}
                                                @if($pegawai->role !== 'admin')
                                                    <li><hr class="dropdown-divider"></li>
                                                    <li>
                                                        <button type="button" class="dropdown-item text-danger" onclick="confirmDelete({{ $pegawai->id }}, '{{ $pegawai->name }}')">
                                                            <i class="ti ti-trash me-2"></i> Hapus Akses
                                                        </button>
                                                    </li>
                                                @endif
                                            </ul>
                                        </div>

                                        {{-- Form Hidden untuk Delete --}}
                                        @if($pegawai->role !== 'admin')
                                            <form action="{{ route('user.destroy', $pegawai->id) }}" method="POST" id="delete-form-{{ $pegawai->id }}" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endif
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

{{-- MODAL DETAIL USER --}}
<div class="modal modal-blur fade" id="modal-detail-pegawai" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header" style="background-color: #fffaf5;">
                <h5 class="modal-title" style="color: #6d4c41;"><i class="ti ti-id me-1"></i> Detail Profil Pegawai</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <span class="avatar avatar-xl rounded-circle bg-azure-lt" id="detail-avatar-init">U</span>
                </div>
                <div class="mb-2">
                    <label class="form-label text-muted small mb-0">Nama Lengkap</label>
                    <div class="fw-bold fs-3" id="detail-name" style="color: #8d6e63;">-</div>
                </div>
                <div class="mb-2">
                    <label class="form-label text-muted small mb-0">Email Sistem</label>
                    <div id="detail-email" class="text-reset">-</div>
                </div>
                <div class="mb-2">
                    <label class="form-label text-muted small mb-0">Hak Akses Sistem</label>
                    <div><span class="badge" id="detail-role">-</span></div>
                </div>
                <div>
                    <label class="form-label text-muted small mb-0">Terdaftar Sejak</label>
                    <div id="detail-created" class="small text-muted">-</div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal" style="background-color: #ba9778; border-color: #ba9778;">Tutup</button>
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
    document.querySelectorAll('.btn-detail').forEach(button => {
        button.addEventListener('click', function() {
            const userId = this.getAttribute('data-id');
            let urlTemplate = "{{ route('user.show', '__ID__') }}";
            let targetUrl = urlTemplate.replace('__ID__', userId);
            fetch(targetUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Gagal mengambil data dari server.');
                    }
                    return response.json();
                })
                .then(data => {
                    document.getElementById('detail-name').innerText = data.name;
                    document.getElementById('detail-email').innerText = data.email;
                    document.getElementById('detail-created').innerText = data.created_at;
                    
                    document.getElementById('detail-avatar-init').innerText = data.name.charAt(0).toUpperCase();

                    const roleBadge = document.getElementById('detail-role');
                    roleBadge.innerText = data.role;
                    if(data.role.toLowerCase() === 'admin') {
                        roleBadge.className = 'badge bg-amber-lt';
                    } else {
                        roleBadge.className = 'badge bg-secondary-lt';
                    }
                    const detailModal = new bootstrap.Modal(document.getElementById('modal-detail-pegawai'));
                    detailModal.show();
                })
                .catch(error => {
                    console.error('Error fetching user details:', error);
                    alert('Terjadi kesalahan saat memuat detail pegawai.');
                });
        });
    });

    // SWAL UNTUK RESET PASSWORD (TERBARU)
    function confirmResetPassword(id, name) {
        Swal.fire({
            title: 'Reset Password Pegawai?',
            text: "Yakin ingin mereset password akun " + name + " menjadi default kembali (12345678)?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#fd7e14',
            cancelButtonColor: '#ba9778',
            confirmButtonText: 'Ya, reset!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('reset-form-' + id).submit();
            }
        })
    }

    // SWAL UNTUK DELETE
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