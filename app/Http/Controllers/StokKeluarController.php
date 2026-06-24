<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StokKeluar;
use App\Models\Produk;
use Illuminate\Support\Facades\DB;

class StokKeluarController extends Controller
{
    public function index()
    {
        $stokKeluar = StokKeluar::with('produk')->latest()->get();
        $produk = Produk::orderBy('nama_produk', 'asc')->get();

        return view('transaksi.keluar', compact('stokKeluar', 'produk'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'produk_id' => 'required|exists:produk,id',
            'jumlah_keluar' => 'required|integer|min:1',
            'tujuan' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request) {
            $produk = Produk::findOrFail($request->produk_id);

            if ($produk->stok_akhir < $request->jumlah_keluar) {
                throw new \Exception("Stok tidak mencukupi! Sisa stok saat ini: {$produk->stok_akhir} Pcs");
            }

            StokKeluar::create([
                'produk_id' => $request->produk_id,
                'jumlah_keluar' => $request->jumlah_keluar,
                'tujuan' => $request->tujuan,
            ]);

            $produk->decrement('stok_akhir', $request->jumlah_keluar);
        });

        return redirect()->route('stok-keluar.index')->with('success', 'Stok keluar berhasil dicatat!');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'jumlah_keluar' => 'required|integer|min:1',
            'tujuan' => 'required|string|max:255',
        ]);

        DB::transaction(function () use ($request, $id) {
            $stokKeluar = StokKeluar::findOrFail($id);
            $produk = Produk::findOrFail($stokKeluar->produk_id);
            $produk->increment('stok_akhir', $stokKeluar->jumlah_keluar);

            if ($produk->fresh()->stok_akhir < $request->jumlah_keluar) {
                throw new \Exception("Gagal Update! Stok tidak mencukupi jika diubah menjadi {$request->jumlah_keluar} Pcs.");
            }

            $stokKeluar->update([
                'jumlah_keluar' => $request->jumlah_keluar,
                'tujuan' => $request->tujuan,
            ]);
            $produk->decrement('stok_akhir', $request->jumlah_keluar);
        });

        return redirect()->route('stok-keluar.index')->with('success', 'Data stok keluar berhasil diperbarui!');
    }

    public function destroy($id)
    {
        DB::transaction(function () use ($id) {
            $stokKeluar = StokKeluar::findOrFail($id);
            $produk = Produk::findOrFail($stokKeluar->produk_id);
            $produk->increment('stok_akhir', $stokKeluar->jumlah_keluar);
            $stokKeluar->delete();
        });

        return redirect()->route('stok-keluar.index')->with('success', 'Data stok keluar berhasil dihapus dan stok produk disesuaikan kembali!');
    }
}