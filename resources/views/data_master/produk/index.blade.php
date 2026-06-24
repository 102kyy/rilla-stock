@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
        
<div class="row align-items-center mb-4">
    <div class="col-12 col-md-6 mb-3 mb-md-0">
        <h1 class="page-title m-0" style="color: #6d4c41; font-weight: 600;">
            <i class="ti ti-package me-2"></i> Master Data Produk
        </h1>
        <div class="text-muted small mt-1">Kelola daftar koleksi kerajinan Macramé kamu di sini.</div>
    </div>
    
    <div class="col-12 col-md-6 d-flex justify-content-md-end align-items-center gap-2">
        <a href="{{ route('produk.export.excel') }}" class="btn btn-success d-inline-flex align-items-center">
            <i class="ti ti-file-spreadsheet me-2"></i> Export Excel
        </a>
        
        <a href="{{ route('produk.export.pdf') }}" class="btn btn-danger d-inline-flex align-items-center me-md-2">
            <i class="ti ti-file-description me-2"></i> Printout PDF
        </a>
        
        <button type="button" class="btn text-white d-inline-flex align-items-center" style="background-color: #ba9778; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#modal-tambah-produk">
            <i class="ti ti-plus me-2"></i> Tambah Produk
        </button>
    </div>
</div>

        <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead style="background-color: #fffaf5;">
                        <tr>
                            <th style="color: #6d4c41;" width="80">Foto</th>
                            <th style="color: #6d4c41;">Nama Produk</th>
                            <th style="color: #6d4c41;">Kategori</th>
                            <th style="color: #6d4c41;">Harga</th>
                            <th style="color: #6d4c41;" class="text-center">Stok Akhir</th>
                            <th style="color: #6d4c41;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produk as $p)
                        <tr>
                            <td>
                                @if($p->foto_produk)
                                    <div class="avatar avatar-md border shadow-sm" style="background-image: url('{{ asset('storage/' . $p->foto_produk) }}'); border-radius: 10px; width: 48px; height: 48px; background-size: cover; background-position: center;"></div>
                                @else
                                    <div class="avatar avatar-md bg-brown-lt fw-bold" style="border-radius: 10px; width: 48px; height: 48px; color: #6d4c41; background-color: #fffaf5; border: 1px dashed #ba9778;">
                                        {{ strtoupper(substr($p->nama_produk, 0, 2)) }}
                                    </div>
                                @endif
                            </td>
                            <td class="fw-bold text-dark">{{ $p->nama_produk }}</td>
                            <td><span class="badge bg-blue-lt">{{ $p->kategori->nama_kategori }}</span></td>
                            <td class="fw-bold text-secondary">Rp {{ number_format($p->harga, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if($p->stok_akhir <= 3)
                                    <span class="badge bg-danger text-white fw-bold" style="border-radius: 6px; padding: 5px 10px;">{{ $p->stok_akhir }} Pcs (Tipis)</span>
                                @else
                                    <span class="badge bg-success text-white fw-bold" style="border-radius: 6px; padding: 5px 10px;">{{ $p->stok_akhir }} Pcs</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <div class="btn-list flex-nowrap justify-content-center">
                                    <button class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $p->id }}">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete({{ $p->id }}, '{{ $p->nama_produk }}')">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                    <form action="{{ route('produk.destroy', $p->id) }}" method="POST" id="delete-form-{{ $p->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal modal-blur fade" id="modal-edit-{{ $p->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="border-radius: 15px; border: none;">
                                    <div class="modal-header" style="background-color: #fffaf5; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                        <h5 class="modal-title" style="color: #6d4c41;">Edit Data Produk ✏️</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('produk.update', $p->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Nama Produk</label>
                                                <input type="text" name="nama_produk" class="form-control" value="{{ $p->nama_produk }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Kategori</label>
                                                <select name="kategori_id" class="form-select" required>
                                                    @foreach($kategori as $k)
                                                        <option value="{{ $k->id }}" {{ $p->kategori_id == $k->id ? 'selected' : '' }}>{{ $k->nama_kategori }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Harga Produk (Rp)</label>
                                                <input type="number" name="harga" class="form-control" value="{{ intval($p->harga) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Tambah Stok Produk <span class="text-muted small fw-normal">(Ketik jumlah produk baru yang selesai dibuat)</span></label>
                                                <div class="input-group">
                                                    <input type="number" name="tambah_stok" class="form-control" min="0" placeholder="Contoh: 5">
                                                    <span class="input-group-text">Pcs</span>
                                                </div>
                                                <div class="form-hint small text-muted">Stok saat ini: <strong class="text-dark">{{ $p->stok_akhir }} Pcs</strong>.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Ganti Foto Produk <span class="text-muted small fw-normal">(Optional)</span></label>
                                                <input type="file" name="foto_produk" class="form-control" accept="image/*">
                                                @if($p->foto_produk)
                                                    <div class="mt-2 text-muted small">Foto saat ini:</div>
                                                    <img src="{{ asset('storage/' . $p->foto_produk) }}" class="mt-1 border shadow-sm" style="max-height: 80px; border-radius: 8px;">
                                                @endif
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
                            <td colspan="6" class="text-center py-5 text-muted">Belum ada data produk terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal modal-blur fade" id="modal-tambah-produk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background-color: #fffaf5; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="modal-title" style="color: #6d4c41;">Tambah Produk Macramé Baru 📦</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Rilla Macrame Wall Hanging" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori Produk</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            @foreach($kategori as $k)
                                <option value="{{ $k->id }}">{{ $k->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Harga Jual (Rp)</label>
                        <input type="number" name="harga" class="form-control" placeholder="Contoh: 150000" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Foto Produk <span class="text-muted small fw-normal">(Optional)</span></label>
                        <input type="file" name="foto_produk" class="form-control" accept="image/*">
                        <div class="form-hint small text-muted">Format file gambar (.jpg, .jpeg, .png). Maks 2MB.</div>
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
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Kamu yakin mau hapus?',
            text: `Produk "${name}" akan dihapus permanen dari sistem Rilla-Stock!`,
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