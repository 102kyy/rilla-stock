<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BahanBaku;
use App\Models\Supplier;
use App\Exports\BahanBakuExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class BahanBakuController extends Controller
{
    public function index()
    {

        $bahanBaku = BahanBaku::with('supplier')->orderBy('id', 'desc')->get();
        $supplier = Supplier::orderBy('nama_supplier', 'asc')->get();

        return view('data_master.bahan_baku.index', compact('bahanBaku', 'supplier'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_id' => 'required|exists:supplier,id',
            'nama_bahan'  => 'required|string|max:255',
            'stok_bahan'  => 'required|integer|min:0',
            'satuan'      => 'required|string|max:50',
            'harga_beli'  => 'required|numeric|min:0',
        ]);

        BahanBaku::create($request->all());

        return redirect()->route('bahan-baku.index')->with('success', 'Bahan baku baru berhasil dicatat! 🧵');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'supplier_id' => 'required|exists:supplier,id',
            'nama_bahan'  => 'required|string|max:255',
            'stok_bahan'  => 'required|integer|min:0',
            'satuan'      => 'required|string|max:50',
            'harga_beli'  => 'required|numeric|min:0',
        ]);

        $bahan = BahanBaku::findOrFail($id);
        $bahan->update($request->all());

        return redirect()->route('bahan-baku.index')->with('success', 'Data bahan baku berhasil diperbarui! ✨');
    }

    public function destroy($id)
    {
        $bahan = BahanBaku::findOrFail($id);
        $bahan->delete();

        return redirect()->route('bahan-baku.index')->with('success', 'Bahan baku berhasil dihapus dari daftar! 🗑️');
    }


    public function exportExcel() 
    {
        return Excel::download(new BahanBakuExport, 'Laporan_Bahan_Baku.xlsx');
    }

    public function exportPdf() 
    {
        $bahanBaku = BahanBaku::with('supplier')->get();
        $pdf = Pdf::loadView('pdf.bahanbaku', compact('bahanBaku'));
        return $pdf->stream('Laporan_Bahan_Baku.pdf');
    }
}