

<?php $__env->startSection('title', 'Stok Masuk'); ?>

<?php $__env->startSection('content'); ?>
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
                                <?php $__empty_1 = true; $__currentLoopData = $stokMasuks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $stok): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($stok->tanggal_masuk)->format('d M Y')); ?></td>
                                    <td class="fw-bold" style="color: #8d6e63;"><?php echo e($stok->bahanBaku->nama_bahan ?? 'Bahan Terhapus'); ?></td>
                                    <td>
                                        <span class="badge bg-purple-lt">
                                            <i class="ti ti-building-store me-1"></i> <?php echo e($stok->bahanBaku->supplier->nama_supplier ?? 'Tanpa Supplier'); ?>

                                        </span>
                                    </td>
                                    <td class="text-center fw-bold text-success">+ <?php echo e($stok->jumlah_masuk); ?> <?php echo e($stok->bahanBaku->satuan ?? ''); ?></td>
                                    <td>
                                        <div class="btn-list flex-nowrap justify-content-center">
                                            <button class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-<?php echo e($stok->id); ?>">
                                                <i class="ti ti-edit"></i>
                                            </button>
                                            
                                            <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete(<?php echo e($stok->id); ?>, '<?php echo e($stok->bahanBaku->nama_bahan ?? 'Bahan'); ?>')">
                                                <i class="ti ti-trash"></i>
                                            </button>

                                            <form action="<?php echo e(route('stok-masuk.destroy', $stok->id)); ?>" method="POST" id="delete-form-<?php echo e($stok->id); ?>" class="d-none">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                            </form>
                                        </div>

                                        <div class="modal modal-blur fade" id="modal-edit-<?php echo e($stok->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content" style="border-radius: 15px;">
                                                    <form action="<?php echo e(route('stok-masuk.update', $stok->id)); ?>" method="POST">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('PUT'); ?>
                                                        <div class="modal-header" style="background-color: #fffaf5;">
                                                            <h5 class="modal-title" style="color: #6d4c41;">Edit Riwayat Stok Masuk</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="mb-3 text-start">
                                                                <label class="form-label fw-bold">Bahan Baku</label>
                                                                <select name="bahan_baku_id" class="form-select" readonly style="background-color: #f8f9fa;">
                                                                    <option value="<?php echo e($stok->bahan_baku_id); ?>"><?php echo e($stok->bahanBaku->nama_bahan ?? ''); ?></option>
                                                                </select>
                                                                <small class="text-muted">* Asal Supplier: <strong class="text-purple"><?php echo e($stok->bahanBaku->supplier->nama_supplier ?? 'Tanpa Supplier'); ?></strong></small>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6 mb-3 text-start">
                                                                    <label class="form-label fw-bold">Jumlah Masuk</label>
                                                                    <input type="number" name="jumlah_masuk" class="form-control" value="<?php echo e($stok->jumlah_masuk); ?>" required>
                                                                </div>
                                                                <div class="col-lg-6 mb-3 text-start">
                                                                    <label class="form-label fw-bold">Tanggal</label>
                                                                    <input type="date" name="tanggal_masuk" class="form-control" value="<?php echo e($stok->tanggal_masuk); ?>" required>
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
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada riwayat stok masuk bahan baku. 🧵</td>
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

<div class="modal modal-blur fade" id="modal-stok-masuk" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-radius: 15px;">
            <form action="<?php echo e(route('stok-masuk.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-header" style="background-color: #fffaf5;">
                    <h5 class="modal-title" style="color: #6d4c41;">Tambah Pasokan Stok Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Bahan Baku</label>
                        <select name="bahan_baku_id" class="form-select" required>
                            <option value="">-- Pilih Logistik Bahan Baku --</option>
                            <?php $__currentLoopData = $bahanBakus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bahan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($bahan->id); ?>">
                                    <?php echo e($bahan->nama_bahan); ?> — (Supplier: <?php echo e($bahan->supplier->nama_supplier ?? 'Tanpa Supplier'); ?>)
                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Jumlah Masuk</label>
                            <input type="number" name="jumlah_masuk" class="form-control" min="1" placeholder="0" required>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label class="form-label fw-bold">Tanggal</label>
                            <input type="date" name="tanggal_masuk" class="form-control" value="<?php echo e(date('Y-m-d')); ?>" required>
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

<?php $__env->startPush('scripts'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rilla-stock\resources\views/transaksi/masuk.blade.php ENDPATH**/ ?>