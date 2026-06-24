<?php

namespace App\Http\Controllers;

use App\Models\StokMasuk;
use App\Models\BahanBaku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StokMasukController extends Controller
{
    public function index()
    {
        $stokMasuks = StokMasuk::with(['bahanBaku.supplier'])->get();
        $bahanBakus = BahanBaku::all();
        
        return view('transaksi.masuk', compact('stokMasuks', 'bahanBakus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'bahan_baku_id' => 'required|exists:bahan_baku,id',
            'jumlah_masuk' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        try {
            DB::beginTransaction();
            StokMasuk::create($request->all());
            $bahan = BahanBaku::findOrFail($request->bahan_baku_id);
            $bahan->increment('stok_bahan', $request->jumlah_masuk);

            DB::commit();
            return redirect()->back()->with('success', 'Stok bahan baku dari supplier berhasil ditambahkan! 🧵');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menambah stok: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'bahan_baku_id' => 'required|exists:bahan_baku,id',
            'jumlah_masuk' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|date',
        ]);

        try {
            DB::beginTransaction();

            $stok = StokMasuk::findOrFail($id);
            $bahan = BahanBaku::findOrFail($request->bahan_baku_id);

            $bahan->decrement('stok_bahan', $stok->jumlah_masuk);

            $stok->update($request->all());

            $bahan->increment('stok_bahan', $request->jumlah_masuk);

            DB::commit();
            return redirect()->back()->with('success', 'Data riwayat stok masuk berhasil diperbarui!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal update data: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            DB::beginTransaction();

            $stok = StokMasuk::findOrFail($id);
            $bahan = BahanBaku::findOrFail($stok->bahan_baku_id);
            
            $bahan->decrement('stok_bahan', $stok->jumlah_masuk);

            $stok->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Riwayat berhasil dihapus dan stok gudang disesuaikan kembali.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Gagal menghapus data.');
        }
    }
}