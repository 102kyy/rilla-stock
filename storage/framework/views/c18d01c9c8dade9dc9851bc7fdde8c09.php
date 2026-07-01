

<?php $__env->startSection('title', 'Profil Saya'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-body" style="background: radial-gradient(circle at top right, #fffdfb 0%, #fcf6f0 100%); min-height: 85vh;">
    <div class="container-xl">
        <!-- Header Section -->
        <div class="row align-items-center mb-4">
            <div class="col">
                <div class="d-flex align-items-center gap-3 flex-wrap">
                     <div style="width: 52px; height: 52px; border-radius: 18px; background: linear-gradient(135deg, #ba9778, #6d4c41); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.4rem; box-shadow: 0 8px 20px rgba(109, 76, 65, 0.15);">
                    <i class="ti ti-heart-handshake"></i>
                </div>
                    <div>
                        <h1 class="page-title mb-1" style="color: #6d4c41; font-family: 'Quicksand', 'Nunito', sans-serif; font-weight: 700;">Pengaturan Akun ☁️</h1>
                        <div class="text-muted small">Ubah kata sandi, lengkapi data profil, dan sesuaikan preferensi ruang kerja estetikmu di sini.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <!-- Left Card: Profile Summary Photo -->
            <div class="col-lg-4">
                <div class="card" style="border-radius: 24px; border: none; box-shadow: 0 10px 30px rgba(109, 76, 65, 0.08); overflow: hidden; background: #ffffff;">
                    <div style="height: 10px; background: linear-gradient(90deg, #ba9778, #8d6e63, #6d4c41);"></div>
                    <div class="card-body text-center py-5">
                        <div class="position-relative d-inline-block mb-3">
                            <span class="avatar avatar-xl" style="background: linear-gradient(135deg, <?php echo e($user->isAdmin() ? '#6d4c41' : '#ba9778'); ?>, <?php echo e($user->isAdmin() ? '#8d6e63' : '#d7ccc8'); ?>); color: white; font-size: 1.5rem; box-shadow: 0 8px 22px rgba(109, 76, 65, 0.18); width: 90px; height: 90px; border-radius: 28px;">
                                <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                            </span>
                            <span class="position-absolute bottom-0 end-0 badge rounded-circle p-2" style="background: #fff; box-shadow: 0 4px 8px rgba(0,0,0,0.08); transform: translate(3px, 3px);">🎀</span>
                        </div>
                        <h3 class="mb-1" style="color: #4e342e; font-weight: 700;"><?php echo e($user->name); ?></h3>
                        <span class="badge rounded-pill px-3 py-2" style="background-color: #fff1e6; color: #6d4c41; border: 1px solid #ebdcd0; font-size: 0.75rem;"><?php echo e(ucfirst($user->role)); ?> Account</span>
                        <p class="text-muted small mt-3 mb-0"><i class="ti ti-fingerprint me-1"></i><?php echo e($user->email); ?></p>
                    </div>
                </div>

                <!-- Info Box (Cute note for user) -->
                <div class="card mt-3" style="border-radius: 20px; border: none; background: #fffaf5; border: 1px dashed #eada00; border-color: #ebdcd0;">
                    <div class="card-body p-3 text-center text-muted small">
                        🤖 <strong>Tips Keamanan:</strong> Gunakan kombinasi kata sandi unik agar kreasi dan data stok kerajinan tanganmu tetap aman terjaga!
                    </div>
                </div>
            </div>

            <!-- Right Card: Account Details (Read Only Overview) -->
            <div class="col-lg-8">
                <div class="card" style="border-radius: 24px; border: none; box-shadow: 0 10px 30px rgba(109, 76, 65, 0.08); overflow: hidden; background: #ffffff;">
                    <div class="card-header py-3" style="background: linear-gradient(90deg, #fffaf5, #ffffff); border-bottom: 1px solid #f5eae1;">
                        <h3 class="card-title mb-0" style="color: #6d4c41; font-weight: 700;"><i class="ti ti-id-badge me-2" style="color: #ba9778;"></i>ID Pengenal Pegawai</h3>
                    </div>
                    <div class="card-body py-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 h-100 rounded-4" style="background: #fdfaf7; border: 1px solid #f3e8de;">
                                    <div class="text-muted small mb-1" style="font-size: 0.75rem;">Nama Lengkap</div>
                                    <div class="fw-bold" style="color: #4e342e;"><?php echo e($user->name); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 h-100 rounded-4" style="background: #fdfaf7; border: 1px solid #f3e8de;">
                                    <div class="text-muted small mb-1" style="font-size: 0.75rem;">Email Resmi</div>
                                    <div class="fw-bold" style="color: #4e342e;"><?php echo e($user->email); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 h-100 rounded-4" style="background: #fdfaf7; border: 1px solid #f3e8de;">
                                    <div class="text-muted small mb-1" style="font-size: 0.75rem;">Level Otoritas</div>
                                    <div class="fw-bold" style="color: #4e342e;"><?php echo e(ucfirst($user->role)); ?></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 h-100 rounded-4" style="background: #fdfaf7; border: 1px solid #f3e8de;">
                                    <div class="text-muted small mb-1" style="font-size: 0.75rem;">Status Akun</div>
                                    <div class="fw-bold text-success"><i class="ti ti-circle-check-filled me-1"></i> Terverifikasi Aktif</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Section: Forms Integration -->
        <div class="row row-cards mt-2">
            <div class="col-12">
                <div class="card" style="border-radius: 26px; border: none; box-shadow: 0 12px 35px rgba(109, 76, 65, 0.09); overflow: hidden; background: #ffffff;">
                    <div class="card-header py-3" style="background: linear-gradient(90deg, #fffaf5, #fcf6f0); border-bottom: 1px solid #f2e4d9;">
                        <h3 class="card-title mb-0" style="color: #6d4c41; font-weight: 700;"><i class="ti ti-feather me-2" style="color: #ba9778;"></i>Formulir Perubahan Data</h3>
                    </div>
                    <div class="card-body bg-white py-4">
                        <div class="row g-4">
                            <!-- Update Profile Form -->
                            <div class="col-lg-6">
                                <div class="p-4 h-100 rounded-4" style="background: radial-gradient(circle at bottom left, #ffffff 0%, #faf5f0 100%); border: 1px solid #eee1d5; box-shadow: 0 4px 15px rgba(109, 76, 65, 0.02);">
                                    <h4 class="mb-3" style="color: #6d4c41; font-weight: 600;"><i class="ti ti-user-edit me-2"></i>Data Profil</h4>
                                    <?php echo $__env->make('profile.partials.update-profile-information-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                </div>
                            </div>
                            <!-- Update Password Form -->
                            <div class="col-lg-6">
                                <div class="p-4 h-100 rounded-4" style="background: radial-gradient(circle at bottom right, #ffffff 0%, #faf5f0 100%); border: 1px solid #eee1d5; box-shadow: 0 4px 15px rgba(109, 76, 65, 0.02);">
                                    <h4 class="mb-3" style="color: #6d4c41; font-weight: 600;"><i class="ti ti-lock-open me-2"></i>Ganti Password</h4>
                                    <?php echo $__env->make('profile.partials.update-password-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                </div>
                            </div>
                        </div>

                        <!-- Danger Zone Form (Delete Account) -->
                        <div class="mt-4">
                            <div class="p-4 rounded-4" style="background: #fff5f5; border: 1px dashed #fcc2c2;">
                                <h4 class="mb-2" style="color: #c93b3b; font-weight: 600;"><i class="ti ti-alert-triangle me-2"></i>Zona Bahaya</h4>
                                <?php echo $__env->make('profile.partials.delete-user-form', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\rilla-stock\resources\views/profile/edit.blade.php ENDPATH**/ ?>