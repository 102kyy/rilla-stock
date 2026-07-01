

<?php $__env->startSection('content'); ?>
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
                <a href="<?php echo e(route('produk.export.excel')); ?>" class="btn btn-success d-inline-flex align-items-center">
                    <i class="ti ti-file-spreadsheet me-2"></i> Export Excel
                </a>
                
                <a href="<?php echo e(route('produk.export.pdf')); ?>" class="btn btn-danger d-inline-flex align-items-center me-md-2">
                    <i class="ti ti-file-description me-2"></i> Printout PDF
                </a>
                
                <button type="button" class="btn text-white d-inline-flex align-items-center" style="background-color: #ba9778; border-radius: 8px;" data-bs-toggle="modal" data-bs-target="#modal-tambah-produk">
                    <i class="ti ti-plus me-2"></i> Tambah Produk
                </button>
            </div>
        </div>

        
        <?php if(session('success')): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <div class="d-flex">
                    <div><i class="ti ti-check me-2"></i></div>
                    <div><?php echo e(session('success')); ?></div>
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        
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
                        <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td>
                                <?php if($p->foto_produk): ?>
                                    <div class="avatar avatar-md border shadow-sm" style="background-image: url('<?php echo e(asset('storage/' . $p->foto_produk)); ?>'); border-radius: 10px; width: 48px; height: 48px; background-size: cover; background-position: center;"></div>
                                <?php else: ?>
                                    <div class="avatar avatar-md bg-brown-lt fw-bold" style="border-radius: 10px; width: 48px; height: 48px; color: #6d4c41; background-color: #fffaf5; border: 1px dashed #ba9778;">
                                        <?php echo e(strtoupper(substr($p->nama_produk, 0, 2))); ?>

                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold text-dark"><?php echo e($p->nama_produk); ?></td>
                            <td><span class="badge bg-blue-lt"><?php echo e($p->kategori->nama_kategori); ?></span></td>
                            <td class="fw-bold text-secondary">Rp <?php echo e(number_format($p->harga, 0, ',', '.')); ?></td>
                            <td class="text-center">
                                <?php if($p->stok_akhir <= 3): ?>
                                    <span class="badge bg-danger text-white fw-bold" style="border-radius: 6px; padding: 5px 10px;"><?php echo e($p->stok_akhir); ?> Pcs (Tipis)</span>
                                <?php else: ?>
                                    <span class="badge bg-success text-white fw-bold" style="border-radius: 6px; padding: 5px 10px;"><?php echo e($p->stok_akhir); ?> Pcs</span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-list flex-nowrap justify-content-center">
                                    
                                    <button class="btn btn-sm btn-icon btn-outline-info btn-detail-produk" data-id="<?php echo e($p->id); ?>">
                                        <i class="ti ti-eye"></i>
                                    </button>

                                    
                                    <button class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-<?php echo e($p->id); ?>">
                                        <i class="ti ti-edit"></i>
                                    </button>

                                    
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete(<?php echo e($p->id); ?>, '<?php echo e($p->nama_produk); ?>')">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                    <form action="<?php echo e(route('produk.destroy', $p->id)); ?>" method="POST" id="delete-form-<?php echo e($p->id); ?>" class="d-none">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        
                        <div class="modal modal-blur fade" id="modal-edit-<?php echo e($p->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="border-radius: 15px; border: none;">
                                    <div class="modal-header" style="background-color: #fffaf5; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                        <h5 class="modal-title" style="color: #6d4c41;">Edit Data Produk ✏️</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="<?php echo e(route('produk.update', $p->id)); ?>" method="POST" enctype="multipart/form-data">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Nama Produk</label>
                                                <input type="text" name="nama_produk" class="form-control" value="<?php echo e($p->nama_produk); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Kategori</label>
                                                <select name="kategori_id" class="form-select" required>
                                                    <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($k->id); ?>" <?php echo e($p->kategori_id == $k->id ? 'selected' : ''); ?>><?php echo e($k->nama_kategori); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Harga Produk (Rp)</label>
                                                <input type="number" name="harga" class="form-control" value="<?php echo e(intval($p->harga)); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Tambah Stok Produk <span class="text-muted small fw-normal">(Ketik jumlah produk baru yang selesai dibuat)</span></label>
                                                <div class="input-group">
                                                    <input type="number" name="tambah_stok" class="form-control" min="0" placeholder="Contoh: 5">
                                                    <span class="input-group-text">Pcs</span>
                                                </div>
                                                <div class="form-hint small text-muted">Stok saat ini: <strong class="text-dark"><?php echo e($p->stok_akhir); ?> Pcs</strong>.</div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Ganti Foto Produk <span class="text-muted small fw-normal">(Optional)</span></label>
                                                <input type="file" name="foto_produk" class="form-control" accept="image/*">
                                                <?php if($p->foto_produk): ?>
                                                    <div class="mt-2 text-muted small">Foto saat ini:</div>
                                                    <img src="<?php echo e(asset('storage/' . $p->foto_produk)); ?>" class="mt-1 border shadow-sm" style="max-height: 80px; border-radius: 8px;">
                                                <?php endif; ?>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Belum ada data produk terdaftar.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>


<div class="modal modal-blur fade" id="modal-detail-produk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px; border: none;">
            <div class="modal-header" style="background-color: #fffaf5; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <h5 class="modal-title" style="color: #6d4c41;"><i class="ti ti-package me-1"></i> Detail Koleksi Produk</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-3 d-flex justify-content-center">
                    <div id="detail-produk-image-container"></div>
                </div>
                
                <div class="mb-3">
                    <label class="form-label text-muted small mb-0">Nama Kerajinan</label>
                    <div class="fw-bold fs-3" id="detail-produk-name" style="color: #6d4c41;">-</div>
                </div>
                <div class="row mb-2">
                    <div class="col-6 text-start">
                        <label class="form-label text-muted small mb-0">Kategori</label>
                        <div><span class="badge bg-blue-lt" id="detail-produk-kategori">-</span></div>
                    </div>
                    <div class="col-6 text-end">
                        <label class="form-label text-muted small mb-0">Sisa Stok</label>
                        <div><span class="badge bg-success text-white fw-bold" id="detail-produk-stok">-</span></div>
                    </div>
                </div>
                <hr class="my-2" style="border-color: #fffaf5;">
                <div class="mb-2 text-start">
                    <label class="form-label text-muted small mb-0">Harga Jual</label>
                    <div class="fw-bold fs-2 text-secondary" id="detail-produk-harga">-</div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal" style="background-color: #6d4c41; border-color: #6d4c41;">Tutup Detail</button>
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
            <form action="<?php echo e(route('produk.store')); ?>" method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Produk</label>
                        <input type="text" name="nama_produk" class="form-control" placeholder="Contoh: Rilla Macrame Wall Hanging" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Kategori Produk</label>
                        <select name="kategori_id" class="form-select" required>
                            <option value="">-- Pilih Kategori --</option>
                            <?php $__currentLoopData = $kategori; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($k->id); ?>"><?php echo e($k->nama_kategori); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // AJAX FETCH DETAIL PRODUK
    document.querySelectorAll('.btn-detail-produk').forEach(button => {
        button.addEventListener('click', function() {
            const produkId = this.getAttribute('data-id');
            
            // Mengambil struktur penamaan route Laravel yang aman
            let urlTemplate = "<?php echo e(route('produk.show', '__ID__')); ?>";
            let targetUrl = urlTemplate.replace('__ID__', produkId);
            
            fetch(targetUrl)
                .then(response => {
                    if(!response.ok) throw new Error('Gagal memuat data produk.');
                    return response.json();
                })
                .then(data => {
                    // Inject data text ke elemen-elemen modal detail
                    document.getElementById('detail-produk-name').innerText = data.nama_produk;
                    document.getElementById('detail-produk-kategori').innerText = data.kategori;
                    document.getElementById('detail-produk-stok').innerText = data.stok_akhir;
                    document.getElementById('detail-produk-harga').innerText = data.harga;
                   // document.getElementById('detail-produk-created').innerText = data.dibuat;
                    
                    // Logic Merender Foto atau Inisial Kotak pembungkus gambar
                    const imgContainer = document.getElementById('detail-produk-image-container');
                    if(data.foto_url) {
                        imgContainer.innerHTML = `<img src="${data.foto_url}" class="border shadow-sm" style="width: 100px; height: 100px; border-radius: 12px; object-fit: cover;">`;
                    } else {
                        imgContainer.innerHTML = `
                            <div class="avatar avatar-xl bg-brown-lt fw-bold border" style="width: 100px; height: 100px; border-radius: 12px; font-size: 2rem; color: #6d4c41; background-color: #fffaf5; border: 2px dashed #ba9778; display: flex; align-items: center; justify-content: center;">
                                ${data.inisial}
                            </div>`;
                    }
                    
                    // Launch / Buka Modal Detailnya
                    const detailModal = new bootstrap.Modal(document.getElementById('modal-detail-produk'));
                    detailModal.show();
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Terjadi kesalahan saat mengambil detail produk.');
                });
        });
    });

    // SWEETALERT CONFIRM DELETE
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rilla-stock\resources\views/data_master/produk/index.blade.php ENDPATH**/ ?>