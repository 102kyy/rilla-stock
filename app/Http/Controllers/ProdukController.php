<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\Kategori; // Pastikan model Kategori di-import jika ada
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    public function index()
    {
        $produk = Produk::with('kategori')->orderBy('id', 'desc')->get();
        $kategori = Kategori::all();
        
        return view('data_master.produk.index', compact('produk', 'kategori'));
    }

    public function show($id)
    {
        $produk = Produk::with('kategori')->findOrFail($id);
        
        return response()->json([
            'nama_produk' => $produk->nama_produk,
            'kategori'    => $produk->kategori->nama_kategori ?? '-',
            'harga'       => 'Rp ' . number_format($produk->harga, 0, ',', '.'),
            'stok_akhir'  => $produk->stok_akhir . ' Pcs',
            'foto_url'    => $produk->foto_produk ? asset('storage/' . $produk->foto_produk) : null,

        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|numeric|min:0',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();
        $input['stok_akhir'] = 0; // Default awal stok baru di-input adalah 0

        if ($request->hasFile('foto_produk')) {
            $input['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
        }

        Produk::create($input);

        return redirect()->route('produk.index')->with('success', 'Produk Macramé baru berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);

        $request->validate([
            'nama_produk' => 'required|string|max:255',
            'kategori_id' => 'required|exists:kategoris,id',
            'harga'       => 'required|numeric|min:0',
            'tambah_stok' => 'nullable|numeric|min:0',
            'foto_produk' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $input = $request->all();
        
        // Akumulasi stok lama dengan stok baru yang ditambahkan
        if ($request->filled('tambah_stok')) {
            $input['stok_akhir'] = $produk->stok_akhir + $request->tambah_stok;
        }

        if ($request->hasFile('foto_produk')) {
            if ($produk->foto_produk) {
                Storage::disk('public')->delete($produk->foto_produk);
            }
            $input['foto_produk'] = $request->file('foto_produk')->store('produk', 'public');
        }

        $produk->update($input);

        return redirect()->route('produk.index')->with('success', 'Data produk berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $produk = Produk::findOrFail($id);

        if ($produk->foto_produk) {
            Storage::disk('public')->delete($produk->foto_produk);
        }

        $produk->delete();

        return redirect()->route('produk.index')->with('success', 'Produk berhasil dihapus dari sistem.');
    }
}