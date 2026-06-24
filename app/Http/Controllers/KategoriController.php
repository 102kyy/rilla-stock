<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use App\Exports\KategoriExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
class KategoriController extends Controller
{
    public function index()
    {
        $kategoris = \App\Models\Kategori::withSum('produks', 'stok_akhir')->get();
        return view('data_master.kategori.index', compact('kategoris'));
    }

        public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
            'status'        => 'required|in:aktif,nonaktif',
        ]);

        \App\Models\Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'status'        => $request->status,
            'total_stok'    => 0,
        ]);

    return redirect()->route('kategori.index')->with('success', 'Kategori baru berhasil ditambahkan! 🧶');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori,' . $id,
            'status'        => 'required|in:aktif,nonaktif',
        ]);

        $kategori = \App\Models\Kategori::findOrFail($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'status'        => $request->status,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil diperbarui! ✨');
    }

    public function destroy($id)
    {
        $kategori = \App\Models\Kategori::findOrFail($id);
        
        // Cek apakah ada produk yang pakai kategori ini (biar gak error relasinya)
        // if($kategori->produk()->count() > 0) {
        //     return redirect()->back()->with('error', 'Gak bisa dihapus karena masih ada produknya sayang!');
        // }

        $kategori->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');
    }

    public function exportExcel() 
    {
        return Excel::download(new KategoriExport, 'Laporan_Kategori_Macrame.xlsx');
    }

    public function exportPdf() 
    {

        $kategoris = Kategori::withCount(['produks as produks_sum_stok_akhir' => function($query) {
            $query->select(\DB::raw('sum(stok_akhir)'));
        }])->get();

        $pdf = Pdf::loadView('pdf.kategori', compact('kategoris'));
        return $pdf->stream('Laporan_Kategori_Macrame.pdf');
    }

}