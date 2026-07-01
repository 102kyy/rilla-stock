

<?php $__env->startSection('title', 'Kategori Produk'); ?>

<?php $__env->startSection('content'); ?>
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
                <a href="<?php echo e(route('kategori.export.excel')); ?>" class="btn btn-success d-inline-flex align-items-center">
                    <i class="ti ti-file-spreadsheet me-2"></i> Export Excel
                </a>
                
                <a href="<?php echo e(route('kategori.export.pdf')); ?>" class="btn btn-danger d-inline-flex align-items-center">
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
                                <?php $__empty_1 = true; $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td class="fw-bold" style="color: #8d6e63;"><?php echo e($kategori->nama_kategori); ?></td>
                                    <td class="text-center"> <?php echo e($kategori->produks_sum_stok_akhir ?? 0); ?> Pcs </td>
                                    <td class="text-center">
                                        <?php if($kategori->status == 'aktif'): ?>
                                            <span class="badge bg-success-lt">Aktif</span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary-lt">Non-Aktif</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-list flex-nowrap justify-content-center">
                                            <button class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-<?php echo e($kategori->id); ?>">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete(<?php echo e($kategori->id); ?>, '<?php echo e($kategori->nama_kategori); ?>')">
                                                <i class="ti ti-trash"></i>
                                            </button>

                                            <form action="<?php echo e(route('kategori.destroy', $kategori->id)); ?>" method="POST" id="delete-form-<?php echo e($kategori->id); ?>" class="d-none">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        </div>
                                    </td>
                                </tr>

                                <div class="modal modal-blur fade" id="modal-edit-<?php echo e($kategori->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content" style="border-radius: 15px;">
                                            <form action="<?php echo e(route('kategori.update', $kategori->id)); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('PUT'); ?>
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Kategori</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Nama Kategori</label>
                                                        <input type="text" name="nama_kategori" class="form-control" value="<?php echo e($kategori->nama_kategori); ?>" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Status</label>
                                                        <select name="status" class="form-select">
                                                            <option value="aktif" <?php echo e($kategori->status == 'aktif' ? 'selected' : ''); ?>>Aktif</option>
                                                            <option value="nonaktif" <?php echo e($kategori->status == 'nonaktif' ? 'selected' : ''); ?>>Non-Aktif</option>
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="5" class="text-center py-4 text-muted italic">Belum ada kategori nih.</td>
                                </tr>
                                <?php endif; ?>
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
            <form action="<?php echo e(route('kategori.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
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

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rilla-stock\resources\views/data_master/kategori/index.blade.php ENDPATH**/ ?>