<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;
use App\Exports\ProdukExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;


class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $kategori = Kategori::orderBy('nama_kategori', 'asc')->get();
        
        $query = Produk::with('kategori');

        if ($request->has('kategori') && $request->kategori != '') {
            $query->where('kategori_id', $request->kategori);
        }
        $produk = $query->orderBy('id', 'desc')->get();

        return view('data_master.produk.index', compact('produk', 'kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id' => 'required|exists:kategori,id',
            'nama_produk' => 'required|string|max:255',
            'harga'       => 'required|numeric|min:0',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048', 
        ]);

        $input = $request->all();
        if ($request->hasFile('foto_produk')) {
           
            $path = $request->file('foto_produk')->store('foto-produk', 'public');
            $input['foto_produk'] = $path;
        }

        Produk::create($input);

        return redirect()->route('produk.index')->with('success', 'Produk baru berhasil ditambahkan! 🧶');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'kategori_id'  => 'required|exists:kategori,id',
            'nama_produk'  => 'required|string|max:255',
            'harga'        => 'required|numeric|min:0',
            'foto_produk'  => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'tambah_stok'  => 'nullable|integer|min:0',
        ]);

        $produk = Produk::findOrFail($id);
        $input = $request->all();

        if ($request->hasFile('foto_produk')) {
            if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
            $path = $request->file('foto_produk')->store('foto-produk', 'public');
            $input['foto_produk'] = $path;
        }

        if ($request->filled('tambah_stok') && $request->tambah_stok > 0) {
            $input['stok_akhir'] = $produk->stok_akhir + $request->tambah_stok;
        }

        $produk->update($input);

        return redirect()->route('produk.index')->with('success', 'Data produk dan stok berhasil diperbarui! ✨');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto_produk && Storage::disk('public')->exists($produk->foto_produk)) {
            Storage::disk('public')->delete($produk->foto_produk);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus dari sistem! 🗑️');
    }

    public function exportExcel()
    {
        return Excel::download(new ProdukExport, 'Laporan_Produk_RillaMacrame.xlsx');
    }

    public function exportPdf()
    {
        $produks = Produk::with('kategori')->get();
        $pdf = Pdf::loadView('pdf.produk', compact('produks'));
        $pdf->setPaper('a4', 'portrait');
        
        return $pdf->stream('Laporan_Produk_RillaMacrame.pdf');
    }
}