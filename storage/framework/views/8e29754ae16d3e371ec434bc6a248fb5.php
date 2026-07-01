

<?php $__env->startSection('title', 'Data Supplier'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row align-items-center mb-2">
            <div class="col-12 col-md-5 mb-3 mb-md-0">
                <h1 class="page-title m-0" style="color: #6d4c41; font-weight: 600;">
                    <i class="ti ti-truck me-2"></i> Daftar Supplier Tali & Bahan
                </h1>
                <div class="text-muted small mt-1">Kelola data mitra penyedia bahan baku macramé kamu.</div>
            </div>
            
            <div class="col-12 col-md-7 d-flex justify-content-md-end align-items-center gap-2 flex-wrap">
                <a href="<?php echo e(route('supplier.export.excel')); ?>" class="btn btn-success d-inline-flex align-items-center">
                    <i class="ti ti-file-spreadsheet me-2"></i> Export Excel
                </a>
                
                <a href="<?php echo e(route('supplier.export.pdf')); ?>" class="btn btn-danger d-inline-flex align-items-center">
                    <i class="ti ti-file-description me-2"></i> Printout PDF
                </a>
                
                <button type="button" class="btn text-white d-inline-flex align-items-center" data-bs-toggle="modal" data-bs-target="#modal-supplier" style="background-color: #ba9778; border-radius: 8px;">
                    <i class="ti ti-plus me-2"></i> Tambah Supplier
                </button>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(186, 151, 120, 0.1);">
            <div class="table-responsive">
                <table class="table table-vcenter card-table">
                    <thead style="background-color: #fffaf5;">
                        <tr>
                            <th class="w-1">No</th>
                            <th>Nama Supplier</th>
                            <th>Kontak/WhatsApp</th>
                            <th>Alamat</th>
                            <th class="w-1 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($key + 1); ?></td>
                            <td class="fw-bold" style="color: #8d6e63;"><?php echo e($s->nama_supplier); ?></td>
                            <td><?php echo e($s->kontak); ?></td>
                            <td class="text-muted small"><?php echo e($s->alamat); ?></td>
                            <td>
                                <div class="btn-list flex-nowrap justify-content-center">
                                    <button class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-<?php echo e($s->id); ?>">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="deleteSupplier(<?php echo e($s->id); ?>, '<?php echo e($s->nama_supplier); ?>')">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                    <form action="<?php echo e(route('supplier.destroy', $s->id)); ?>" method="POST" id="delete-form-<?php echo e($s->id); ?>" class="d-none">
                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal Edit (Inside Loop) -->
                        <div class="modal modal-blur fade" id="modal-edit-<?php echo e($s->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="border-radius: 15px;">
                                    <form action="<?php echo e(route('supplier.update', $s->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                                        <div class="modal-header">
                                            <h5 class="modal-title">Edit Supplier</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Nama Supplier</label>
                                                <input type="text" name="nama_supplier" class="form-control" value="<?php echo e($s->nama_supplier); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Kontak</label>
                                                <input type="text" name="kontak" class="form-control" value="<?php echo e($s->kontak); ?>">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Alamat</label>
                                                <textarea name="alamat" class="form-control" rows="3"><?php echo e($s->alamat); ?></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-warning ms-auto">Update Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada supplier yang terdaftar.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah (Outside Loop) -->
<div class="modal modal-blur fade" id="modal-supplier" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <form action="<?php echo e(route('supplier.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header" style="background-color: #fffaf5;">
                    <h5 class="modal-title" style="color: #6d4c41;">Tambah Supplier Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Supplier</label>
                        <input type="text" name="nama_supplier" class="form-control" placeholder="Contoh: Toko Tali Katun Bandung" required>
                    </div>
                   <div class="mb-3">
                        <label class="form-label fw-bold">Kontak Supplier</label>
                        <input type="text" name="kontak" class="form-control" placeholder="Contoh: @tokotali_ig / 0812xxx / email@toko.com">
                        <small class="text-muted">Bisa diisi username IG, No. WA, atau Email.</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Alamat</label>
                        <textarea name="alamat" class="form-control" placeholder="Alamat lengkap toko/supplier" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary ms-auto" style="background-color: #ba9778; border-color: #ba9778;">Simpan Supplier</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function deleteSupplier(id, name) {
        Swal.fire({
            title: 'Hapus Supplier?',
            text: "Kamu yakin mau hapus " + name + "? Data yang terhapus tidak bisa dikembalikan.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ba9778', 
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rilla-stock\resources\views/data_master/supplier/index.blade.php ENDPATH**/ ?>