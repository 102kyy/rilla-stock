<aside class="navbar navbar-vertical navbar-expand-lg navbar-light border-end" style="background-color: #fffaf5;">
    <div class="container-fluid">
        <div class="navbar-brand py-4">
            <a href="<?php echo e(route('dashboard')); ?>">
                <img src="<?php echo e(asset('assets/images/rillacumacrame.png')); ?>" style="height: 80px; filter: drop-shadow(0 2px 4px rgba(186, 151, 120, 0.2));" alt="Rilla Stock">
            </a>
        </div>

        <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav">
                
                <li class="nav-item <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>">
                    <a class="nav-link side-link" href="<?php echo e(route('dashboard')); ?>">
                        <span class="nav-link-icon" style="color: #8d6e63;"><i class="ti ti-layout-dashboard"></i></span>
                        <span class="nav-link-title">Dashboard</span>
                    </a>
                </li>
                
                <?php if(Auth::user()->isAdmin()): ?>
                <li class="nav-item">
                    <div class="px-3 py-3 small fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.65rem; color: #ba9778;">Master Data</div>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('produk.index') ? 'active' : ''); ?>">
                    <a class="nav-link side-link" href="<?php echo e(route('produk.index')); ?>">
                        <span class="nav-link-icon" style="color: #8d6e63;"><i class="ti ti-box"></i></span>
                        <span class="nav-link-title">Daftar Produk</span>
                    </a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('bahan-baku.index') ? 'active' : ''); ?>">
                    <a class="nav-link side-link" href="<?php echo e(route('bahan-baku.index')); ?>">
                        <span class="nav-link-icon" style="color: #8d6e63;"><i class="ti ti-needle"></i></span>
                        <span class="nav-link-title">Bahan Baku</span>
                    </a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('kategori.index') ? 'active' : ''); ?>">
                    <a class="nav-link side-link" href="<?php echo e(route('kategori.index')); ?>">
                        <span class="nav-link-icon" style="color: #8d6e63;"><i class="ti ti-tags"></i></span>
                        <span class="nav-link-title">Kategori</span>
                    </a>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('supplier.index') ? 'active' : ''); ?>">
                    <a class="nav-link side-link" href="<?php echo e(route('supplier.index')); ?>">
                        <span class="nav-link-icon" style="color: #8d6e63;"><i class="ti ti-building-store"></i></span>
                        <span class="nav-link-title">Supplier</span>
                    </a>
                </li>
                <?php endif; ?>

                <li class="nav-item <?php echo e(Auth::user()->isAdmin() ? 'mt-2' : ''); ?>">
                    <div class="px-3 py-3 small fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.65rem; color: #ba9778;">Transaksi</div>
                </li>
                <li class="nav-item <?php echo e(request()->is('stok-masuk*') ? 'active' : ''); ?>">
                    <a class="nav-link side-link" href="<?php echo e(route('stok-masuk.index')); ?>">
                        <span class="nav-link-icon text-success"><i class="ti ti-circle-arrow-down"></i></span>
                        <span class="nav-link-title">Stok Masuk</span>
                    </a>
                </li>
                <li class="nav-item <?php echo e(request()->is('stok-keluar*') ? 'active' : ''); ?>">
                    <a class="nav-link side-link" href="<?php echo e(route('stok-keluar.index')); ?>">
                        <span class="nav-link-icon text-danger"><i class="ti ti-circle-arrow-up"></i></span>
                        <span class="nav-link-title">Stok Keluar</span>
                    </a>
                </li>
                
                <li class="nav-item mt-2">
                    <div class="px-3 py-3 small fw-bold text-uppercase" style="letter-spacing: 1px; font-size: 0.65rem; color: #ba9778;">Lainnya</div>
                </li>
                <li class="nav-item <?php echo e(request()->routeIs('laporan.index') ? 'active' : ''); ?>">
                    <a class="nav-link side-link" href="<?php echo e(route('laporan.index')); ?>">
                        <span class="nav-link-icon" style="color: #8d6e63;"><i class="ti ti-chart-pie"></i></span>
                        <span class="nav-link-title">Laporan</span>
                    </a>
                </li>
                
                <?php if(Auth::user()->isAdmin()): ?>
                <li class="nav-item <?php echo e(request()->routeIs('user.index') ? 'active' : ''); ?>">
                    <a class="nav-link side-link" href="<?php echo e(route('user.index')); ?>">
                        <span class="nav-link-icon" style="color: #8d6e63;"><i class="ti ti-users"></i></span>
                        <span class="nav-link-title">Manajemen User</span>
                    </a>
                </li>
                <?php endif; ?>

            </ul>
        </div>
    </div>
</aside>

<style>
    .navbar-vertical .nav-link.side-link:hover {
        background-color: #fdf2e9 !important;
        color: #ba9778 !important;
    }
    .navbar-vertical .nav-item.active .nav-link.side-link {
        background-color: #ba9778 !important;
        color: #ffffff !important;
    }
    .navbar-vertical .nav-item.active .nav-link.side-link .nav-link-icon,
    .navbar-vertical .nav-item.active .nav-link.side-link .nav-link-icon i {
        color: #ffffff !important;
    }
    .navbar-vertical .nav-item.active .nav-link.side-link .nav-link-title {
        color: #ffffff !important;
    }
</style><?php /**PATH C:\laragon\www\rilla-stock\resources\views/layouts/sidebar.blade.php ENDPATH**/ ?>