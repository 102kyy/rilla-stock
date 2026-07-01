<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\StokKeluarController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StokMasukController;
use App\Http\Controllers\BahanBakuController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\ForgotPasswordController;

Route::get('/', function () {
    return view('welcome');
});

// =========================================================================
// ROUTE GRUP UMUM (Bisa Diakses oleh Semua yang Sudah Login: Admin & Pegawai)
// =========================================================================
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Pengaturan Profil Pribadi
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::put('/atur-ulang-password', [ProfileController::class, 'updatePassword'])->name('password.update');
    
    // Transaksi Stok
    Route::resource('stok-masuk', StokMasukController::class);
    Route::resource('stok-keluar', StokKeluarController::class);

    // Laporan & Cetak/Ekspor Laporan
    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/cetak', [LaporanController::class, 'cetak'])->name('laporan.cetak');
    Route::get('/laporan/export/excel', [LaporanController::class, 'exportExcel'])->name('laporan.export.excel');
    Route::get('/laporan/export/pdf', [LaporanController::class, 'exportPdf'])->name('laporan.export.pdf');

});

// =========================================================================
// ROUTE GRUP KHUSUS ADMIN (Pegawai Tidak Bisa Mengakses URL di Bawah Ini)
// =========================================================================
Route::middleware(['auth', 'verified', 'admin'])->group(function () {

    // Master Data: Produk
    Route::get('/produk', [ProdukController::class, 'index'])->name('produk.index');
    Route::post('/produk/store', [ProdukController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}', [ProdukController::class, 'show'])->name('produk.show');
    Route::put('/produk/update/{id}', [ProdukController::class, 'update'])->name('produk.update');
    Route::delete('/produk/hapus/{id}', [ProdukController::class, 'destroy'])->name('produk.destroy');
    Route::get('/produk/export/excel', [ProdukController::class, 'exportExcel'])->name('produk.export.excel');
    Route::get('/produk/export/pdf', [ProdukController::class, 'exportPdf'])->name('produk.export.pdf');

    // Master Data: Kategori
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::put('/kategori/update/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/hapus/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');
    Route::get('/kategori/export/excel', [KategoriController::class, 'exportExcel'])->name('kategori.export.excel');
    Route::get('/kategori/export/pdf', [KategoriController::class, 'exportPdf'])->name('kategori.export.pdf');

    // Master Data: Supplier (Route Custom Harus Diatas Resource)
    Route::get('/supplier/export/excel', [SupplierController::class, 'exportExcel'])->name('supplier.export.excel');
    Route::get('/supplier/export/pdf', [SupplierController::class, 'exportPdf'])->name('supplier.export.pdf');
    Route::resource('supplier', SupplierController::class);

    // Master Data: Bahan Baku (Route Custom Harus Diatas Resource)
    Route::get('/bahan-baku/export/excel', [BahanBakuController::class, 'exportExcel'])->name('bahan-baku.export.excel');
    Route::get('/bahan-baku/export/pdf', [BahanBakuController::class, 'exportPdf'])->name('bahan-baku.export.pdf');
    Route::resource('bahan-baku', BahanBakuController::class);

    // Manajemen User / Pegawai
    Route::get('/manajemen-user', [UserController::class, 'index'])->name('user.index');
    Route::post('/manajemen-user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/manajemen-user/{id}', [UserController::class, 'show'])->name('user.show');
    Route::put('/manajemen-user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::put('/admin/users/{user}/reset-password', [\App\Http\Controllers\UserController::class, 'resetPasswordByAdmin'])->name('admin.users.reset-password');
    Route::delete('/manajemen-user/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    // Route Pemulihan Password Kustom (Bypass dari bajakan sistem internal Laravel)
    Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
    Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('atur-ulang-password/{token}', [ForgotPasswordController::class, 'showResetForm'])->name('password.custom_reset');
    Route::post('atur-ulang-password', [ForgotPasswordController::class, 'resetPassword'])->name('password.custom_update');
        });

require __DIR__.'/auth.php';