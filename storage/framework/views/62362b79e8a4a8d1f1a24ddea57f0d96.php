<header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none border-bottom" style="background-color: #fff9f5;">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <!-- Bagian Kiri: Search Bar Estetik -->
        <div class="collapse navbar-collapse" id="navbar-menu">
            <div>
                <form action="./" method="get" autocomplete="off" novalidate>
                    <div class="input-icon">
                        <span class="input-icon-addon">
                            <i class="ti ti-search text-muted"></i>
                        </span>
                        <input type="text" value="" class="form-control" placeholder="Cari stok produk..." aria-label="Search in website" style="border-radius: 20px; border-color: #f1e4d8; background-color: #fff;">
                    </div>
                </form>
            </div>
        </div>

        <!-- Bagian Kanan: Ikon & Profil -->
        <div class="navbar-nav flex-row order-md-last ms-auto">
            <div class="d-none d-md-flex me-3">
                <!-- Ikon Notifikasi -->
                <a href="?theme=dark" class="nav-link px-0 me-3" title="Mode Gelap" data-bs-toggle="tooltip" data-bs-placement="bottom">
                    <i class="ti ti-moon"></i>
                </a>
                <div class="nav-item dropdown d-none d-md-flex me-3">
                    <a href="#" class="nav-link px-0" data-bs-toggle="dropdown" tabindex="-1" aria-label="Show notifications">
                        <i class="ti ti-bell"></i>
                        <span class="badge bg-red text-red-fg badge-blink"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-end dropdown-menu-card">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">Notifikasi Terbaru</h3></div>
                            <div class="list-group list-group-flush list-group-hoverable">
                                <div class="list-group-item">
                                    <div class="row align-items-center">
                                        <div class="col-auto"><span class="status-dot status-dot-animated bg-red d-block"></span></div>
                                        <div class="col text-truncate">
                                            <a href="#" class="text-body d-block">Stok Tali Katun Menipis!</a>
                                            <div class="d-block text-muted text-truncate mt-n1">Sisa 2 Roll lagi nih, segera restock ya Kiara.</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Menu -->
            <div class="nav-item dropdown">
                <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                    <span class="avatar avatar-sm shadow-sm" style="background-image: url(https://ui-avatars.com/api/?name=<?php echo e(urlencode(Auth::user()->name)); ?>&background=ba9778&color=fff)"></span>
                    <div class="d-none d-xl-block ps-2 text-start">
                        <div class="fw-bold"><?php echo e(Auth::user()->name); ?></div>
                        <div class="mt-1 small text-muted" style="font-size: 0.7rem;"><?php echo e(ucfirst(Auth::user()->role)); ?> Rilla Stock</div>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                    <a href="<?php echo e(route('profile.edit')); ?>" class="dropdown-item">
                        <i class="ti ti-user-circle me-2"></i> Akun Saya
                    </a>
                    <a href="#" class="dropdown-item">
                        <i class="ti ti-settings me-2"></i> Pengaturan
                    </a>
                    <div class="dropdown-divider"></div>
                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <a href="<?php echo e(route('logout')); ?>" class="dropdown-item text-danger" 
                           onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="ti ti-logout me-2"></i> Keluar Sistem
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header><?php /**PATH C:\laragon\www\rilla-stock\resources\views/layouts/header.blade.php ENDPATH**/ ?>