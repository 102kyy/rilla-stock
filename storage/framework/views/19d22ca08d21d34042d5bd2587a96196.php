

<?php $__env->startSection('content'); ?>
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
                        <?php $__empty_1 = true; $__currentLoopData = $stokKeluar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td><?php echo e($sk->created_at ? \Carbon\Carbon::parse($sk->created_at)->format('d M Y (H:i)') : \Carbon\Carbon::now()->format('d M Y (H:i)')); ?></td>
                            <td class="fw-bold"><?php echo e($sk->produk->nama_produk ?? 'Produk Terhapus'); ?></td>
                            <td class="text-center text-danger fw-bold">- <?php echo e($sk->jumlah_keluar); ?> Pcs</td>
                            <td>
                                <?php if($sk->tujuan == 'Terjual'): ?>
                                    <span class="badge bg-success-lt">🛒 Terjual</span>
                                <?php elseif($sk->tujuan == 'Rusak'): ?>
                                    <span class="badge bg-danger-lt">⚠️ Rusak</span>
                                <?php elseif($sk->tujuan == 'Kado/Hadiah'): ?>
                                    <span class="badge bg-purple-lt">🎁 Kado/Hadiah</span>
                                <?php else: ?>
                                    <span class="badge bg-blue-lt">✨ <?php echo e($sk->tujuan); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-list flex-nowrap justify-content-center">
                                    <button class="btn btn-sm btn-icon btn-outline-warning" data-bs-toggle="modal" data-bs-target="#modal-edit-<?php echo e($sk->id); ?>">
                                        <i class="ti ti-edit"></i>
                                    </button>
                                    
                                    <button type="button" class="btn btn-sm btn-icon btn-outline-danger" onclick="confirmDelete(<?php echo e($sk->id); ?>, '<?php echo e($sk->produk->nama_produk ?? 'Produk'); ?>')">
                                        <i class="ti ti-trash"></i>
                                    </button>

                                    <form action="<?php echo e(route('stok-keluar.destroy', $sk->id)); ?>" method="POST" id="delete-form-<?php echo e($sk->id); ?>" class="d-none">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                    </form>
                                </div>
                            </td>
                        </tr>

                        <div class="modal modal-blur fade" id="modal-edit-<?php echo e($sk->id); ?>" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content" style="border-radius: 15px; border: none;">
                                    <div class="modal-header" style="background-color: #fffaf5; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                                        <h5 class="modal-title" style="color: #6d4c41;">Edit Data Stok Keluar ✏️</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="<?php echo e(route('stok-keluar.update', $sk->id)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label class="form-label fw-bold text-muted">Produk (Locked)</label>
                                                <input type="text" class="form-control" value="<?php echo e($sk->produk->nama_produk ?? ''); ?>" disabled>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Jumlah Keluar (Pcs)</label>
                                                <input type="number" name="jumlah_keluar" class="form-control" min="1" value="<?php echo e($sk->jumlah_keluar); ?>" required>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label fw-bold">Tujuan / Keperluan</label>
                                                <select name="tujuan" class="form-select" required>
                                                    <option value="Terjual" <?php echo e($sk->tujuan == 'Terjual' ? 'selected' : ''); ?>>Terjual</option>
                                                    <option value="Kado/Hadiah" <?php echo e($sk->tujuan == 'Kado/Hadiah' ? 'selected' : ''); ?>>Kado/Hadiah</option>
                                                    <option value="Rusak" <?php echo e($sk->tujuan == 'Rusak' ? 'selected' : ''); ?>>Rusak</option>
                                                    <option value="Display/Pameran" <?php echo e($sk->tujuan == 'Display/Pameran' ? 'selected' : ''); ?>>Display/Pameran</option>
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
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">Belum ada riwayat stok keluar. 🧵</td>
                        </tr>
                        <?php endif; ?>
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
            
            <form action="<?php echo e(route('stok-keluar.store')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pilih Produk</label>
                        <select name="produk_id" class="form-select" required>
                            <option value="">-- Pilih Produk Macramé --</option>
                            <?php $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($p->id); ?>"><?php echo e($p->nama_produk); ?> (Sisa Stok: <?php echo e($p->stok_akhir); ?> Pcs)</option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        <?php if(session('success')): ?>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "<?php echo e(session('success')); ?>",
                confirmButtonColor: '#6d4c41',
                timer: 3000
            });
        <?php endif; ?>

        <?php if($errors->any()): ?>
            Swal.fire({
                icon: 'error',
                title: 'Waduh, Gagal!',
                html: `<?php echo implode('<br>', $errors->all()); ?>`,
                confirmButtonColor: '#ba9778'
            });
        <?php endif; ?>
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rilla-stock\resources\views/transaksi/keluar.blade.php ENDPATH**/ ?>