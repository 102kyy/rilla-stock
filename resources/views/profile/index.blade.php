@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')
<div class="page-body" style="background: radial-gradient(circle at top right, #fffdfb 0%, #fcf6f0 100%); min-height: 85vh;">
    <div class="container-xl">
        <!-- Header Section -->
        <div class="row align-items-center mb-4">
            <div class="col">
                <div class="d-flex align-items-center gap-3">
                    <div style="width: 52px; height: 52px; border-radius: 18px; background: linear-gradient(135deg, #ba9778, #6d4c41); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.4rem; box-shadow: 0 8px 20px rgba(109, 76, 65, 0.15); transform: rotate(-3deg);">
                        <i class="ti ti-heart-handshake"></i>
                    </div>
                    <div>
                        <h1 class="page-title mb-1" style="color: #6d4c41; font-family: 'Quicksand', 'Nunito', sans-serif; font-weight: 700;">Profil Kak {{ $user->isAdmin() ? 'Admin' : 'Pegawai' }} ✨</h1>
                        <div class="text-muted small">Ruang detail akun pribadi Anda. Terpelihara hangat dalam ekosistem rajutan rajani.</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row row-cards">
            <!-- Left Card: Avatar & Quick Info -->
            <div class="col-lg-4">
                <div class="card" style="border-radius: 24px; border: 2px dashed #eada00; border: none; box-shadow: 0 10px 30px rgba(109, 76, 65, 0.08); background: #ffffff; position: relative; overflow: hidden;">
                    <!-- Decorative Circle Background -->
                    <div style="position: absolute; top: -40px; right: -40px; width: 120px; height: 120px; background: #fff8f2; border-radius: 50%; z-index: 0;"></div>
                    
                    <div class="card-body text-center py-5" style="position: relative; z-index: 1;">
                        <div class="position-relative d-inline-block mb-3">
                            <span class="avatar avatar-xl" style="background: linear-gradient(135deg, {{ $user->isAdmin() ? '#6d4c41' : '#ba9778' }}, {{ $user->isAdmin() ? '#8d6e63' : '#d7ccc8' }}); color: white; font-size: 1.6rem; box-shadow: 0 10px 25px rgba(109, 76, 65, 0.2); width: 96px; height: 96px; border-radius: 32px;">
                                {{ strtoupper(substr($user->name, 0, 1)) }}
                            </span>
                            <span class="position-absolute bottom-0 end-0 badge rounded-circle p-2" style="background: #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transform: translate(5px, 5px);">🌿</span>
                        </div>
                        <h3 class="mb-1" style="color: #4e342e; font-weight: 700;">{{ $user->name }}</h3>
                        <span class="badge rounded-pill px-3 py-2 my-2" style="background: {{ $user->isAdmin() ? 'linear-gradient(135deg, #6d4c41, #8d6e63)' : 'linear-gradient(135deg, #ba9778, #dfba9b)' }}; color: white; font-size: 0.75rem; letter-spacing: 0.5px; box-shadow: 0 4px 12px rgba(109, 76, 65, 0.15);">
                            🎨 {{ ucfirst($user->role) }}
                        </span>
                        <div class="p-2 mt-3 rounded-3" style="background: #fffaf5; border: 1px dashed #ebdcd0;">
                            <p class="text-muted small mb-0"><i class="ti ti-mail me-1"></i>{{ $user->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Card: Information Blocks -->
            <div class="col-lg-8">
                <div class="card" style="border-radius: 24px; border: none; box-shadow: 0 10px 30px rgba(109, 76, 65, 0.08); overflow: hidden; background: #ffffff;">
                    <div class="card-header py-3" style="background: linear-gradient(90deg, #fffaf5, #ffffff); border-bottom: 1px solid #f5eae1;">
                        <h3 class="card-title mb-0" style="color: #6d4c41; font-weight: 700;"><i class="ti ti-bookmark me-2" style="color: #ba9778;"></i>Informasi Akun Pokok</h3>
                    </div>
                    <div class="card-body py-4">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="p-3 h-100 rounded-4 transition-card" style="background: #fdfaf7; border: 1px solid #f3e8de;">
                                    <div class="text-muted small mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px; text-transform: uppercase;">Nama Lengkap</div>
                                    <div class="fw-bold" style="color: #4e342e; font-size: 1.05rem;"><i class="ti ti-user me-2" style="color: #ba9778;"></i>{{ $user->name }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 h-100 rounded-4" style="background: #fdfaf7; border: 1px solid #f3e8de;">
                                    <div class="text-muted small mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px; text-transform: uppercase;">Alamat Surel</div>
                                    <div class="fw-bold" style="color: #4e342e; font-size: 1.05rem;"><i class="ti ti-mail me-2" style="color: #ba9778;"></i>{{ $user->email }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 h-100 rounded-4" style="background: #fdfaf7; border: 1px solid #f3e8de;">
                                    <div class="text-muted small mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px; text-transform: uppercase;">Hak Peran</div>
                                    <div class="fw-bold" style="color: #4e342e; font-size: 1.05rem;"><i class="ti ti-shield me-2" style="color: #ba9778;"></i>{{ ucfirst($user->role) }}</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 h-100 rounded-4" style="background: #fdfaf7; border: 1px solid #f3e8de;">
                                    <div class="text-muted small mb-1" style="font-size: 0.75rem; letter-spacing: 0.5px; text-transform: uppercase;">Status Aktivitas</div>
                                    <div class="fw-bold text-success" style="font-size: 1.05rem;"><span class="badge badge-blink bg-success me-2"></span>Aktif Bekerja</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Card: Access Permissions -->
        <div class="row row-cards mt-2">
            <div class="col-12">
                <div class="card" style="border-radius: 24px; border: none; box-shadow: 0 10px 30px rgba(109, 76, 65, 0.08); overflow: hidden; background: #ffffff;">
                    <div class="card-header py-3" style="background: linear-gradient(90deg, #fffaf5, #ffffff); border-bottom: 1px solid #f5eae1;">
                        <h3 class="card-title mb-0" style="color: #6d4c41; font-weight: 700;"><i class="ti ti-stars me-2" style="color: #ba9778;"></i>Hak Akses & Fokus Kerja Kamu</h3>
                    </div>
                    <div class="card-body">
                        @if($user->isAdmin())
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="alert mb-0 rounded-4" role="alert" style="background: #fffdf5; border: 1px solid #f9eed2; color: #7c5e10;">
                                        <div class="d-flex gap-2">
                                            <span style="font-size: 1.3rem;">👑</span>
                                            <div>
                                                <strong style="color: #5d4300; font-size: 0.95rem;">Manajer Utama (Admin)</strong><br>
                                                <span class="small opacity-85">Kamu memegang kendali penuh atas manajemen produk rajutan macramé, pengawasan stok benang, laporan laba, serta manajemen akun tim operasional.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert mb-0 rounded-4" role="alert" style="background: #f5fafd; border: 1px solid #dbedf7; color: #265c83;">
                                        <div class="d-flex gap-2">
                                            <span style="font-size: 1.3rem;">🎯</span>
                                            <div>
                                                <strong style="color: #164366; font-size: 0.95rem;">Kendali Mutu & Prioritas</strong><br>
                                                <span class="small opacity-85">Pantau grafik ketersediaan stok produk secara berkala, lakukan validasi data pesanan masuk, dan kelola kelancaran sirkulasi Rilla Stock.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="alert mb-0 rounded-4" role="alert" style="background: #f6fdf9; border: 1px solid #def4e8; color: #1e663e;">
                                        <div class="d-flex gap-2">
                                            <span style="font-size: 1.3rem;">🧶</span>
                                            <div>
                                                <strong style="color: #114627; font-size: 0.95rem;">Kolega Pelaksana (Pegawai)</strong><br>
                                                <span class="small opacity-85">Fokus utama kamu adalah menjaga ketelitian pencatatan kuantitas stok harian, meng-update katalog macramé baru, dan mencatat mutasi barang keluar.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="alert mb-0 rounded-4" role="alert" style="background: #fbfbfe; border: 1px solid #ebebfa; color: #434388;">
                                        <div class="d-flex gap-2">
                                            <span style="font-size: 1.3rem;">📝</span>
                                            <div>
                                                <strong style="color: #2b2b66; font-size: 0.95rem;">Catatan Alur Kerja</strong><br>
                                                <span class="small opacity-85">Pastikan setiap detail kerajinan yang terjual atau restock terdata di sistem tepat waktu agar sinkronisasi laporan akhir bulan tetap rapi ya!</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .badge-blink {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        animation: blink 1.4s infinite ease-in-out;
    }
    @keyframes blink {
        0% { opacity: 0.4; transform: scale(0.9); }
        50% { opacity: 1; transform: scale(1.1); }
        100% { opacity: 0.4; transform: scale(0.9); }
    }
</style>
@endsection