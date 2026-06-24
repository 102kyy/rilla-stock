@extends('layouts.app')

@section('content')
<div class="page-body">
    <div class="container-xl">
        
        <div class="row align-items-center mb-4">
            <div class="col-12 col-md-5 mb-3 mb-md-0">
                <h1 class="page-title m-0" style="color: #6d4c41; font-weight: 600;">
                    <i class="ti ti-box-seam me-2"></i> Logistik Bahan Baku
                </h1>
                <div class="text-muted small mt-1">Pantau persediaan benang, tali, kayu dowel, dan manik-manik produksi Macramé.</div>
            </div>
            
            <div class="col-12 col-md-7 d-flex justify-content-md-end align-items-center gap-2 flex-wrap">
                <a href="{{ route('bahan-baku.export.excel') }}" class="btn btn-success d-inline-flex align-items-center">
                    <i class="ti ti-file-spreadsheet me-2"></i> Export Excel
                </a>
                
                <a href="{{ route('bahan-baku.export.pdf') }}" class="btn btn-danger d-inline-flex align-items-center">
                    <i class="ti ti-file-description me-2"></i> Printout PDF
                </a>
                
                <button type="button" class="btn text-white d-inline-flex align-items-center" style="background-color: #ba9778; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#modal-tambah-bahan">
                    <i class="ti ti-plus me-2"></i> Tambah Bahan Baku
                </button>
            </div>
        </div>

        <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(0,0,0,0.05);">
            <div class="table-responsive">
                <table class="table card-table table-vcenter text-nowrap datatable">
                    <thead style="background-color: #fffaf5;">
                        <tr>
                            <th style="color: #6d4c41;">Nama Bahan Baku</th>
                            <th style="color: #6d4c41;">Supplier Asal</th>
                            <th style="color: #6d4c41;" class="text-center">Stok Gudang</th>
                            <th style="color: #6d4c41;">Harga Beli Satuan</th>
                            <th style="color: #6d4c41;" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bahanBaku as $bb)
                        <tr>
                            <td class="fw-bold text-dark">{{ $bb->nama_bahan }}</td>
                            <td><span class="badge bg-purple-lt">🏢 {{ $bb->supplier->nama_supplier }}</span></td>
                            <td class="text-center">
                                <span class="badge bg-indigo text-white fw-bold" style="border-radius: 6px; padding: 5px 10px;">
                                    {{ $bb->stok_bahan }} {{ $bb->satuan }}
                                </span>
                            </td>
                            <td class="fw-bold text-secondary">Rp {{ number_format($bb->harga_beli, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <div class="btn-list flex-nowrap justify-content-center">
                                    <button class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $bb->id }}">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete({{ $bb->id }}, '{{ $bb->nama_bahan }}')">
                                        <i class="ti ti-trash"></i>
                                    </button>

                                    <form action="{{ route('bahan-baku.destroy', $bb->id) }}" method="POST" id="delete-form-{{ $bb->id }}" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal modal-blur fade" id="modal-edit-{{ $bb->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="border-radius: 15px; border: none;">
                                    <div class="modal-header" style="background-color: #fffaf5; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                        <h5 class="modal-title" style="color: #6d4c41;">Edit Data Bahan Baku ✏️</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="{{ route('bahan-baku.update', $bb->id) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Nama Bahan Baku</label>
                                                <input type="text" name="nama_bahan" class="form-control" value="{{ $bb->nama_bahan }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Supplier</label>
                                                <select name="supplier_id" class="form-select" required>
                                                    @foreach($supplier as $s)
                                                        <option value="{{ $s->id }}" {{ $bb->supplier_id == $s->id ? 'selected' : '' }}>{{ $s->nama_supplier }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-bold">Stok Sekarang</label>
                                                    <input type="number" name="stok_bahan" class="form-control" value="{{ $bb->stok_bahan }}" required>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label class="form-label fw-bold">Satuan Ukuran</label>
                                                    <input type="text" name="satuan" class="form-control" value="{{ $bb->satuan }}" placeholder="Contoh: Roll, Meter, Pcs" required>
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Harga Beli Per Satuan (Rp)</label>
                                                <input type="number" name="harga_beli" class="form-control" value="{{ intval($bb->harga_beli) }}" required>
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
                            <td colspan="5" class="text-center py-5 text-muted">Gudang kosong. Belum ada bahan baku terdaftar.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<div class="modal modal-blur fade" id="modal-tambah-bahan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background-color: #fffaf5; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="modal-title" style="color: #6d4c41;">Tambah Stok Bahan Baku Baru 📦</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('bahan-baku.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Bahan Baku</label>
                        <input type="text" name="nama_bahan" class="form-control" placeholder="Contoh: Tali Katun Macrame 4mm" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Supplier Pembelian</label>
                        <select name="supplier_id" class="form-select" required>
                            <option value="">-- Pilih Supplier --</option>
                            @foreach($supplier as $s)
                                <option value="{{ $s->id }}">{{ $s->nama_supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Jumlah Stok Masuk</label>
                            <input type="number" name="stok_bahan" class="form-control" min="0" placeholder="Contoh: 20" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Satuan Ukuran</label>
                            <input type="text" name="satuan" class="form-control" placeholder="Contoh: Roll / Meter / Pcs" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Harga Beli Per Satuan (Rp)</label>
                        <input type="number" name="harga_beli" class="form-control" placeholder="Contoh: 45000" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn text-white" style="background-color: #6d4c41;">Simpan Bahan Baku</button>
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
        // SWAL Notif Sukses Simpan/Edit/Hapus (Sudah diperbaiki format penafsirannya bby)
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{!! session('success') !!}",
                confirmButtonColor: '#6d4c41',
                timer: 3000
            });
        @endif

        // SWAL Notif Gagal / Validasi Eror
        @if($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Waduh, Gagal!',
                html: `{!! implode('<br>', $errors->all()) !!}`,
                confirmButtonColor: '#ba9778'
            });
        @endif
    });

    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Kamu yakin mau hapus?',
            text: `Bahan baku "${name}" akan dihapus permanen dari logistik inventory Rilla-Stock!`,
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