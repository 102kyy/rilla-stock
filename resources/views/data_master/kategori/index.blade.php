@extends('layouts.app')

@section('title', 'Kategori Produk')

@section('content')
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row align-items-center mb-2">
            <div class="col-12 col-md-5 mb-3 mb-md-0">
                <h1 class="page-title m-0" style="color: #6d4c41; font-weight: 600;">
                    <i class="ti ti-tags me-2"></i> Kategori Produk Macramé
                </h1>
                <div class="text-muted small mt-1">Kelola kategori untuk merapikan stok Rilla-Stock kamu.</div>
            </div>
            
            <div class="col-12 col-md-7 d-flex justify-content-md-end align-items-center gap-2 flex-wrap">
                <a href="{{ route('kategori.export.excel') }}" class="btn btn-success d-inline-flex align-items-center">
                    <i class="ti ti-file-spreadsheet me-2"></i> Export Excel
                </a>
                
                <a href="{{ route('kategori.export.pdf') }}" class="btn btn-danger d-inline-flex align-items-center">
                    <i class="ti ti-file-description me-2"></i> Printout PDF
                </a>
                
                <button type="button" class="btn text-white d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal-kategori" style="background-color: #ba9778; border-radius: 8px;">
                    <i class="ti ti-plus me-2"></i> Tambah Kategori
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
                                    <th>Nama Kategori</th>
                                    <th class="text-center">Total Stok</th>
                                    <th class="text-center">Status</th>
                                    <th class="w-1 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($kategoris as $key => $kategori)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td class="fw-bold" style="color: #8d6e63;">{{ $kategori->nama_kategori }}</td>
                                    <td class="text-center"> {{ $kategori->produks_sum_stok_akhir ?? 0 }} Pcs </td>
                                    <td class="text-center">
                                        @if($kategori->status == 'aktif')
                                            <span class="badge bg-success-lt">Aktif</span>
                                        @else
                                            <span class="badge bg-secondary-lt">Non-Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap justify-content-center">
                                            <button class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-{{ $kategori->id }}">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete({{ $kategori->id }}, '{{ $kategori->nama_kategori }}')">
                                                <i class="ti ti-trash"></i>
                                            </button>

                                            <form action="{{ route('kategori.destroy', $kategori->id) }}" method="POST" id="delete-form-{{ $kategori->id }}" class="d-none">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal modal-blur fade" id="modal-edit-{{ $kategori->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content" style="border-radius: 15px;">
                                            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Kategori</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Nama Kategori</label>
                                                        <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="aktif" {{ $kategori->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                            <option value="nonaktif" {{ $kategori->status == 'nonaktif' ? 'selected' : '' }}>Non-Aktif</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                                                    <button type="submit" class="btn btn-warning ms-auto">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted italic">Belum ada kategori nih.</td>
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

<div class="modal modal-blur fade" id="modal-kategori" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="modal-header" style="background-color: #fffaf5;">
                    <h5 class="modal-title" style="color: #6d4c41;">Kategori Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Wall Hanging" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Status Kategori</label>
                        <select name="status" class="form-select">
                            <option value="aktif">Aktif</option>
                            <option value="nonaktif">Non-Aktif</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary ms-auto" style="background-color: #ba9778; border-color: #ba9778;">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function confirmDelete(id, name) {
        Swal.fire({
            title: 'Hapus Kategori?',
            text: "Yakin mau hapus kategori " + name + "? Data ini nggak bisa balik lagi.",
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