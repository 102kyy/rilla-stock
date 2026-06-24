<!-- <!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Rilla-Stock</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/rillacumacrame.png') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-flags.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-payments.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler-vendors.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

  <style>
    /* Hilangkan scrollbar */
    html, body, .page {
        overflow: -moz-scrollbars-none;
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    html::-webkit-scrollbar, body::-webkit-scrollbar, .page::-webkit-scrollbar {
        display: none !important;
        width: 0 !important;
    }
    .navbar-vertical .nav-link.side-link {
        padding: 0.6rem 1rem;
        margin: 0 0.8rem 0.2rem 0.8rem;
        border-radius: 6px;
        color: #495057;
        font-weight: 500;
    }
    .navbar-vertical .nav-item.active .nav-link.side-link {
        background-color: #eef4fb;
        color: #206bc4;
    }
  </style>
</head>

<body class="d-flex flex-column">
  <div class="page">
    <aside class="navbar navbar-vertical navbar-expand-lg navbar-light bg-white border-end">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar-menu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbar-brand py-4">
                <a href=".">
                    <img src="{{ asset('assets/images/rillacumacrame.png') }}" style="height: 70px; width: auto; object-fit: contain;" alt="Rilla Stock">
                </a>
            </div>
            <div class="collapse navbar-collapse" id="sidebar-menu">
            <ul class="navbar-nav">
                
                <li class="nav-item">
                    <div class="px-3 py-2 small fw-bold text-uppercase text-muted-lite" style="letter-spacing: 1px; font-size: 0.65rem;">Master Data</div>
                </li>
                <li class="nav-item">
                    <a class="nav-link side-link" href="#">
                        <span class="nav-link-icon"><i class="ti ti-box"></i></span>
                        <span class="nav-link-title">Daftar Produk</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link side-link" href="#">
                        <span class="nav-link-icon"><i class="ti ti-tags"></i></span>
                        <span class="nav-link-title">Kategori</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link side-link" href="#">
                        <span class="nav-link-icon"><i class="ti ti-building-store"></i></span>
                        <span class="nav-link-title">Supplier</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <div class="px-3 py-2 small fw-bold text-uppercase text-muted-lite" style="letter-spacing: 1px; font-size: 0.65rem;">Transaksi</div>
                </li>
                <li class="nav-item active">
                    <a class="nav-link side-link" href="#">
                        <span class="nav-link-icon"><i class="ti ti-layout-dashboard"></i></span>
                        <span class="nav-link-title">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link side-link" href="#">
                        <span class="nav-link-icon text-success"><i class="ti ti-circle-arrow-up"></i></span>
                        <span class="nav-link-title">Stok Masuk</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link side-link" href="#">
                        <span class="nav-link-icon text-danger"><i class="ti ti-circle-arrow-down"></i></span>
                        <span class="nav-link-title">Stok Keluar</span>
                    </a>
                </li>

                <li class="nav-item mt-3">
                    <div class="px-3 py-2 small fw-bold text-uppercase text-muted-lite" style="letter-spacing: 1px; font-size: 0.65rem;">Lainnya</div>
                </li>
                <li class="nav-item">
                    <a class="nav-link side-link" href="#">
                        <span class="nav-link-icon"><i class="ti ti-chart-pie"></i></span>
                        <span class="nav-link-title">Laporan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link side-link" href="#">
                        <span class="nav-link-icon"><i class="ti ti-settings"></i></span>
                        <span class="nav-link-title">Manajemen User</span>
                    </a>
                </li>
            </ul>
            </div>
        </div>
    </aside>

    <div class="page-wrapper">
        <header class="navbar navbar-expand-md navbar-light d-none d-lg-flex d-print-none border-bottom">
            <div class="container-fluid">
                <div class="navbar-nav flex-row order-md-last ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0" data-bs-toggle="dropdown" aria-label="Open user menu">
                            <span class="avatar avatar-sm" style="background-image: url(./static/avatars/000f.jpg)"></span>
                            <div class="d-none d-xl-block ps-2 text-start">
                                <div class="fw-bold">Kiara Danisha </div>
                                <div class="mt-1 small text-muted">Owner Rilla Stock</div>
                            </div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                            <a href="#" class="dropdown-item"><i class="ti ti-user-edit me-2"></i> Edit Profile</a>
                            <a href="#" class="dropdown-item"><i class="ti ti-key me-2"></i> Ganti Password</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" class="dropdown-item text-danger"><i class="ti ti-logout me-2"></i> Logout</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="page-body">
            <div class="container-xl">
                <div class="row align-items-center mb-3">
                    <div class="col">
                        <h1 class="page-title">Selamat Datang di Rilla-Stock, Admin!</h1>
                        <div class="text-muted small mt-1">Pantau stok tali katun dan pesanan macrame kamu dengan mudah hari ini. ✨</div>
                    </div>
                </div>

                <div class="row row-cards">
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-sm"><div class="card-body"><div class="row align-items-center"><div class="col-auto"><span class="bg-primary text-white avatar"><i class="ti ti-receipt"></i></span></div><div class="col"><div class="font-weight-medium">Total Pendapatan</div><div class="text-muted">Rp 2.500.000</div></div></div></div></div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-sm"><div class="card-body"><div class="row align-items-center"><div class="col-auto"><span class="bg-info text-white avatar"><i class="ti ti-box"></i></span></div><div class="col"><div class="font-weight-medium">Stok Bahan</div><div class="text-muted">15 Roll Tali</div></div></div></div></div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-sm"><div class="card-body"><div class="row align-items-center"><div class="col-auto"><span class="bg-warning text-white avatar"><i class="ti ti-hammer"></i></span></div><div class="col"><div class="font-weight-medium">Diproses</div><div class="text-muted">8 Produk</div></div></div></div></div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="card card-sm"><div class="card-body"><div class="row align-items-center"><div class="col-auto"><span class="bg-success text-white avatar"><i class="ti ti-truck"></i></span></div><div class="col"><div class="font-weight-medium">Siap Kirim</div><div class="text-muted">5 Paket</div></div></div></div></div>
                    </div>
                </div>

                <div class="row row-cards mt-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header"><h3 class="card-title">Aktivitas Terakhir Rilla Stock</h3></div>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter text-nowrap datatable">
                                    <thead><tr><th>Produk/Bahan</th><th>Status</th><th>Jumlah</th><th>Waktu</th></tr></thead>
                                    <tbody>
                                        <tr><td>Wall Hanging Boho Large</td><td><span class="badge bg-warning">Proses Produksi</span></td><td>1 Pcs</td><td>2 jam yang lalu</td></tr>
                                        <tr><td>Tali Katun 4mm Putih</td><td><span class="badge bg-info">Barang Masuk</span></td><td>10 Roll</td><td>5 jam yang lalu</td></tr>
                                        <tr><td>Macrame Keychain Mini</td><td><span class="badge bg-success">Berhasil Terjual</span></td><td>12 Pcs</td><td>Kemarin</td></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div> </div> </div> </div> <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
</body>
</html> -->