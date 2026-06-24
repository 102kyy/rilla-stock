@extends('layouts.app')

@section('title', 'Stok Masuk')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row align-items-center">
            <div class="col">
                <h2 class="page-title" style="color: #6d4c41;">Riwayat Stok Masuk 📥</h2>
                <div class="text-muted mt-1">Catat dan pantau pasokan logistik bahan baku produksi Macramé dari supplier.</div>
            </div>
            <div class="col-auto ms-auto">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modal-stok-masuk" style="background-color: #ba9778; border-color: #ba9778;">
                    <i class="ti ti-plus me-2"></i> Tambah Stok Masuk
                </button>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(186, 151, 120, 0.1);">
                    <div class="table-responsive">
                        <table class="table table-vcenter card-table">
                            <thead style="background-color: #fffaf5;">
                                <tr>
                                    <th class="w-1">No</th>
                                    <th>Tanggal</th>
                                    <th>Nama Bahan Baku</th>
                                    <th>Supplier Asal</th>
                                    <th class="text-center">Jumlah</th>
                                    <th class="w-1 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($stokMasuks as $key => $stok)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ \Carbon\Carbon::parse($stok->tanggal_masuk)->format('d M Y') }}</td>
                                    <td class="fw-bold" style="color: #8d6e63;">{{ $stok->bahanBaku->nama_bahan ?? 'Bahan Terhapus' }}</td>
                                    <td>
                                        <span class="badge bg-purple-lt">
                                            <i class="ti ti-building-store me-1"></i> {{ $stok->bahanBaku->supplier->nama_supplier ?? 'Tanpa Supplier' }}
                                        </span>
                                    </td>
                                    <td class="text-center fw-bold text-success">+ {{ $stok->jumlah_masuk }} {{ $stok->bahanBaku->satuan ?? '' }}</td>
                                    <td>
                                        <div class="btn-list flex-nowrap justify-content-center">
                                            <button class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $stok->id }}">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete({{ $stok->id }}, '{{ $stok->bahanBaku->nama_bahan ?? 'Bahan' }}')">
                                                <i class="ti ti-trash"></i>
                                            </button>

                                            <form action="{{ route('stok-masuk.destroy', $stok->id) }}" method="POST" id="delete-form-{{ $stok->id }}" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>

                                        <div class="modal modal-blur fade" id="modal-edit-{{ $stok->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content" style="border-radius: 15px;">
                                                    <form action="{{ route('stok-masuk.update', $stok->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-header" style="background-color: #fffaf5;">
                                                            <h5 class="modal-title" style="color: #6d4c41;">Edit Riwayat Stok Masuk</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3 text-start">
                                                                <label class="form-label fw-bold">Bahan Baku</label>
                                                                <select name="bahan_baku_id" class="form-select" readonly style="background-color: #f8f9fa;">
                                                                    <option value="{{ $stok->bahan_baku_id }}">{{ $stok->bahanBaku->nama_bahan ?? '' }}</option>
                                                                </select>
                                                                <small class="text-muted">* Asal Supplier: <strong class="text-purple">{{ $stok->bahanBaku->supplier->nama_supplier ?? 'Tanpa Supplier' }}</strong></small>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3 text-start">
                                                                    <label class="form-label fw-bold">Jumlah Masuk</label>
                                                                    <input type="number" name="jumlah_masuk" class="form-control" value="{{ $stok->jumlah_masuk }}" required>
                                                                </div>
                                                                <div class="col-lg-6 mb-3 text-start">
                                                                    <label class="form-label fw-bold">Tanggal</label>
                                                                    <input type="date" name="tanggal_masuk" class="form-control" value="{{ $stok->tanggal_masuk }}" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                                                            <button type="submit" class="btn btn-warning ms-auto">Simpan Perubahan</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada riwayat stok masuk bahan baku. 🧵</td>
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

<div class="modal modal-blur fade" id="modal-stok-masuk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <form action="{{ route('stok-masuk.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background-color: #fffaf5;">
                    <h5 class="modal-title" style="color: #6d4c41;">Tambah Pasokan Stok Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Bahan Baku</label>
                        <select name="bahan_baku_id" class="form-select" required>
                            <option value="">-- Pilih Logistik Bahan Baku --</option>
                            @foreach($bahanBakus as $bahan)
                                <option value="{{ $bahan->id }}">
                                    {{ $bahan->nama_bahan }} — (Supplier: {{ $bahan->supplier->nama_supplier ?? 'Tanpa Supplier' }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Jumlah Masuk</label>
                            <input type="number" name="jumlah_masuk" class="form-control" min="1" placeholder="0" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" name="tanggal_masuk" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary ms-auto" style="background-color: #ba9778; border-color: #ba9778;">Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete(id, bahanName) {
        Swal.fire({
            title: 'Hapus Riwayat?',
            text: "Yakin mau hapus data stok masuk untuk " + bahanName + "? Stok bahan baku di gudang bakal berkurang otomatis lho.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#ba9778',
            confirmButtonText: 'Ya, hapus!',
            cancelButtonText: 'Batal',
            background: '#fffaf5'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
@endpush
@endsection