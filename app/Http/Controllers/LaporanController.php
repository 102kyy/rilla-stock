<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokMasuk; 
use App\Models\StokKeluar; 
use App\Exports\LaporanArusStokExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tanggal_mulai = $request->get('tanggal_mulai');
        $tanggal_selesai = $request->get('tanggal_selesai');

        // Setup dasar query eager loading
        $queryMasuk = StokMasuk::with(['bahanBaku']);
        $queryKeluar = StokKeluar::with(['produk']); // Menggunakan relasi produk

        // Filter data berdasarkan tanggal input jika dipilih
        if ($tanggal_mulai && $tanggal_selesai) {
            $queryMasuk->whereBetween('tanggal_masuk', [$tanggal_mulai, $tanggal_selesai]);
            $queryKeluar->whereBetween('created_at', [$tanggal_mulai . ' 00:00:00', $tanggal_selesai . ' 23:59:59']);
        }

        // Eksekusi pengambilan data dari database
        $laporanMasuk = $queryMasuk->latest()->get();
        $laporanKeluar = $queryKeluar->latest()->get(); // FIX: Variabel terisi dan tidak undefined lagi

        return view('laporan.index', compact('laporanMasuk', 'laporanKeluar', 'tanggal_mulai', 'tanggal_selesai'));
    }

    public function exportExcel(Request $request) 
    {
        $tgl_mulai = $request->get('tanggal_mulai');
        $tgl_selesai = $request->get('tanggal_selesai');

        return Excel::download(
            new LaporanArusStokExport($tgl_mulai, $tgl_selesai), 
            'Laporan_Arus_Stok_Macrame.xlsx'
        );
    }

    public function exportPdf(Request $request) 
    {
        $tanggal_mulai = $request->get('tanggal_mulai');
        $tanggal_selesai = $request->get('tanggal_selesai');

        $queryMasuk = StokMasuk::with(['bahanBaku']);
        $queryKeluar = StokKeluar::with(['produk']); // FIX: Ubah dari bahanBaku ke produk agar tidak RelationNotFound

        if ($tanggal_mulai && $tanggal_selesai) {
            $queryMasuk->whereBetween('tanggal_masuk', [$tanggal_mulai, $tanggal_selesai]);
            $queryKeluar->whereBetween('created_at', [$tanggal_mulai . ' 00:00:00', $tanggal_selesai . ' 23:59:59']);
        }

        $laporanMasuk = $queryMasuk->latest()->get();
        $laporanKeluar = $queryKeluar->latest()->get();

        $pdf = Pdf::loadView('pdf.laporan', compact('laporanMasuk', 'laporanKeluar', 'tanggal_mulai', 'tanggal_selesai'));
        return $pdf->stream('Laporan_Arus_Stok_Macrame.pdf');
    }
}