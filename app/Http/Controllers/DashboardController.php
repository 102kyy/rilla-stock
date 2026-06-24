<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Produk::count();
        $totalKategori = Kategori::count();
        $totalStok = Produk::sum('stok_akhir'); 
        
        // Estimasi nilai (Dibuat dinamis atau tetap placeholder)
        $totalPendapatan = 2500000;         
        $produkTerbaru = Produk::with('kategori')->orderBy('id', 'desc')->take(5)->get();
        $kategoriData = Kategori::withCount('produks')->get(); 
        $chartLabels = $kategoriData->pluck('nama_kategori');
        $chartValues = $kategoriData->pluck('produks_count');


        return view('dashboard', compact(
            'totalProduk', 
            'totalKategori', 
            'totalStok', 
            'totalPendapatan',
            'produkTerbaru',
            'chartLabels',
            'chartValues'
        ));
    }
}