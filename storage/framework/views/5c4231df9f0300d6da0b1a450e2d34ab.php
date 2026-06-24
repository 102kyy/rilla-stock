

<?php $__env->startSection('title', 'Laporan Stok'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header d-print-none">
    <div class="container-xl">
        <div class="row align-items-center mb-2">
            <div class="col-12 col-md-5 mb-3 mb-md-0">
                <h1 class="page-title m-0" style="color: #6d4c41; font-weight: 600;">
                    <i class="ti ti-report me-2"></i> Laporan Arus Stok
                </h1>
                <div class="text-muted small mt-1">Pantau dan rekapitulasi data transaksi stok masuk dan keluar secara real-time.</div>
            </div>
            
            <div class="col-12 col-md-7 d-flex justify-content-md-end align-items-center gap-2 flex-wrap">
                <a href="<?php echo e(route('laporan.export.excel', ['tanggal_mulai' => $tanggal_mulai, 'tanggal_selesai' => $tanggal_selesai])); ?>" class="btn btn-success d-inline-flex align-items-center">
                    <i class="ti ti-file-spreadsheet me-2"></i> Export Excel
                </a>
                
                <a href="<?php echo e(route('laporan.export.pdf', ['tanggal_mulai' => $tanggal_mulai, 'tanggal_selesai' => $tanggal_selesai])); ?>" class="btn btn-danger d-inline-flex align-items-center" target="_blank">
                    <i class="ti ti-file-description me-2"></i> Printout PDF
                </a>
            </div>
        </div>
    </div>
</div>

<div class="page-body">
    <div class="container-xl">
        <div class="card mb-4" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(186, 151, 120, 0.05);">
            <div class="card-body">
                <form action="<?php echo e(route('laporan.index')); ?>" method="GET">
                    <div class="row align-items-end g-3">
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold small text-muted">Tanggal Mulai</label>
                            <input type="date" name="tanggal_mulai" class="form-control" value="<?php echo e($tanggal_mulai); ?>">
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-bold small text-muted">Tanggal Selesai</label>
                            <input type="date" name="tanggal_selesai" class="form-control" value="<?php echo e($tanggal_selesai); ?>">
                        </div>
                        <div class="col-12 col-md-4 d-flex gap-2">
                            <button type="submit" class="btn text-white w-100" style="background-color: #ba9778; border-color: #ba9778;">
                                <i class="ti ti-filter me-2"></i> Filter Data
                            </button>
                            <?php if($tanggal_mulai || $tanggal_selesai): ?>
                                <a href="<?php echo e(route('laporan.index')); ?>" class="btn btn-outline-secondary w-100">
                                    Reset
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div class="card" style="border-radius: 15px; border: none; box-shadow: 0 5px 15px rgba(186, 151, 120, 0.1); overflow: hidden;">
            <div class="card-header p-0">
                <ul class="nav nav-tabs card-header-tabs m-0" data-bs-toggle="tabs" style="background-color: #fffaf5;">
                    <li class="nav-item">
                        <a href="#tabs-stok-masuk" class="nav-tab-link nav-link active py-3 px-4 fw-bold" data-bs-toggle="tab" style="color: #6d4c41;">
                            <i class="ti ti-arrow-down-bar me-2 text-success"></i> Stok Masuk
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#tabs-stok-keluar" class="nav-tab-link nav-link py-3 px-4 fw-bold" data-bs-toggle="tab" style="color: #6d4c41;">
                            <i class="ti ti-arrow-up-bar me-2 text-danger"></i> Stok Keluar
                        </a>
                    </li>
                </ul>
            </div>
            
            <div class="card-body p-0">
                <div class="tab-content">
                    
                    <div class="tab-pane fade show active" id="tabs-stok-masuk">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped m-0">
                                <thead style="background-color: #fffaf5;">
                                    <tr>
                                        <th class="w-1 text-center">No</th>
                                        <th>Tanggal</th>
                                        <th>Bahan Baku</th>
                                        <th class="text-center">Jumlah Masuk</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $laporanMasuk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $masuk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($key + 1); ?></td>
                                        <td><?php echo e(\Carbon\Carbon::parse($masuk->tanggal)->format('d F Y')); ?></td>
                                        <td class="fw-bold" style="color: #8d6e63;"><?php echo e($masuk->bahanBaku->nama_bahan ?? 'Bahan Terhapus'); ?></td>
                                        <td class="text-center fw-bold text-success">+ <?php echo e($masuk->jumlah_masuk); ?> Pcs</td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="4" class="text-center py-4 text-muted italic">Tidak ada transaksi stok masuk dalam periode ini.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tabs-stok-keluar">
                        <div class="table-responsive">
                            <table class="table table-vcenter card-table table-striped m-0">
                                <thead style="background-color: #fffaf5;">
                                    <tr>
                                        <th class="w-1 text-center">No</th>
                                        <th>Tanggal</th>
                                        <th>Bahan Baku / Produk</th>
                                        <th>Keterangan Keperluan</th>
                                        <th class="text-center">Jumlah Keluar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $laporanKeluar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $keluar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td class="text-center"><?php echo e($key + 1); ?></td>
                                        
                                        <td><?php echo e($keluar->created_at ? \Carbon\Carbon::parse($keluar->created_at)->format('d F Y') : \Carbon\Carbon::now()->format('d F Y')); ?>

                                        </td>
                                        
                                        <td class="fw-bold" style="color: #8d6e63;">
                                            <?php echo e($keluar->produk->nama_produk ?? 'Produk Terhapus'); ?>

                                        </td> 
                                        
                                        <td><?php echo e($keluar->tujuan ?? '-'); ?></td> 
                                        
                                        <td class="text-center fw-bold text-danger">
                                            - <?php echo e($keluar->jumlah_keluar); ?> Pcs
                                        </td> 
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted italic">Tidak ada transaksi stok keluar dalam periode ini.</td>
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
</div>

<style>
    .nav-tabs .nav-link.active {
        border-bottom-color: #ba9778 !important;
        background-color: #fff !important;
    }
    .form-control:focus {
        border-color: #ba9778 !important;
        box-shadow: 0 0 0 0.25rem rgba(186, 151, 120, 0.25) !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rilla-stock\resources\views/laporan/index.blade.php ENDPATH**/ ?>