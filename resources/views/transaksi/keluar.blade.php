@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
        
        <div class="row align-items-center mb-4">
            <div class="col">
                <h1 class="page-title" style="color: #6d4c41;">Manajemen Stok Keluar 📦</h1>
                <div class="text-muted small mt-1">Catat dan pantau pengeluaran stok produk Macramé kamu.</div>
            </div>
            <div class="col-auto ms-auto">
                <button type="button" class="btn text-white" style="background-color: #ba9778; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#modal-stok-keluar">
                    <i class="ti ti-plus me-2"></i> Tambah Stok Keluar
                </button>
            </div>
        </div>

        <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead style="background-color: #fffaf5;">
                        <tr>
                            <th style="color: #6d4c41;">Tanggal</th>
                            <th style="color: #6d4c41;">Nama Produk</th>
                            <th style="color: #6d4c41;" class="text-center">Jumlah Keluar</th>
                            <th style="color: #6d4c41;">Tujuan / Keperluan</th>
                            <th style="color: #6d4c41;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($stokKeluar as $sk)
                        <tr>
                            <td>{{ $sk->created_at ? \Carbon\Carbon::parse($sk->created_at)->format('d M Y (H:i)') : \Carbon\Carbon::now()->format('d M Y (H:i)') }}</td>
                            <td class="fw-bold">{{ $sk->produk->nama_produk ?? 'Produk Terhapus' }}</td>
                            <td class="text-center text-danger fw-bold">- {{ $sk->jumlah_keluar }} Pcs</td>
                            <td>
                                @if($sk->tujuan == 'Terjual')
                                    <span class="badge bg-success-lt">🛒 Terjual</span>
                                @elseif($sk->tujuan == 'Rusak')
                                    <span class="badge bg-danger-lt">⚠️ Rusak</span>
                                @elseif($sk->tujuan == 'Kado/Hadiah')
                                    <span class="badge bg-purple-lt">🎁 Kado/Hadiah</span>
                                @else
                                    <span class="badge bg-blue-lt">✨ {{ $sk->tujuan }}</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-list flex-nowrap justify-content-center">
                                    <button class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $sk->id }}">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete({{ $sk->id }}, '{{ $sk->produk->nama_produk ?? 'Produk' }}')">
                                        <i class="ti ti-trash"></i>
                                    </button>

                                    <form action="{{ route('stok-keluar.destroy', $sk->id) }}" method="POST" id="delete-form-{{ $sk->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal modal-blur fade" id="modal-edit-{{ $sk->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="border-radius: 15px; border: none;">
                                    <div class="modal-header" style="background-color: #fffaf5; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                        <h5 class="modal-title" style="color: #6d4c41;">Edit Data Stok Keluar ✏️</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('stok-keluar.update', $sk->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Produk (Locked)</label>
                                                <input type="text" class="form-control" value="{{ $sk->produk->nama_produk ?? '' }}" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Jumlah Keluar (Pcs)</label>
                                                <input type="number" name="jumlah_keluar" class="form-control" min="1" value="{{ $sk->jumlah_keluar }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Tujuan / Keperluan</label>
                                                <select name="tujuan" class="form-select" required>
                                                    <option value="Terjual" {{ $sk->tujuan == 'Terjual' ? 'selected' : '' }}>Terjual</option>
                                                    <option value="Kado/Hadiah" {{ $sk->tujuan == 'Kado/Hadiah' ? 'selected' : '' }}>Kado/Hadiah</option>
                                                    <option value="Rusak" {{ $sk->tujuan == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                                                    <option value="Display/Pameran" {{ $sk->tujuan == 'Display/Pameran' ? 'selected' : '' }}>Display/Pameran</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn text-white" style="background-color: #6d4c41;">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Belum ada riwayat stok keluar. 🧵</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal modal-blur fade" id="modal-stok-keluar" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background-color: #fffaf5; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="modal-title" style="color: #6d4c41;">Catat Transaksi Stok Keluar 📝</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <form action="{{ route('stok-keluar.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Produk</label>
                        <select name="produk_id" class="form-select" required>
                            <option value="">-- Pilih Produk Macramé --</option>
                            @foreach($produk as $p)
                                <option value="{{ $p->id }}">{{ $p->nama_produk }} (Sisa Stok: {{ $p->stok_akhir }} Pcs)</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jumlah Keluar (Pcs)</label>
                        <input type="number" name="jumlah_keluar" class="form-control" min="1" placeholder="Contoh: 3" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tujuan / Keperluan</label>
                        <select name="tujuan" class="form-select" required>
                            <option value="">-- Pilih Tujuan Pengeluaran --</option>
                            <option value="Terjual">Terjual</option>
                            <option value="Kado/Hadiah">Kado/Hadiah</option>
                            <option value="Rusak">Rusak</option>
                            <option value="Display/Pameran">Display/Pameran</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #6d4c41;">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonColor: '#6d4c41',
                timer: 3000
            });
        @endif

        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Waduh, Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#ba9778'
            });
        @endif
    });

    function confirmDelete(id, namaProduk) {
        Swal.fire({
            title: 'Kamu yakin mau hapus?',
            text: `Data stok keluar untuk "${namaProduk}" akan dihapus dan stok produk otomatis disesuaikan kembali!`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6d4c41',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-form-${id}`).submit();
            }
        });
    }
</script>
@endpush