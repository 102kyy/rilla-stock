<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Exports\SupplierExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class SupplierController extends Controller
{
    public function index()
    {
        // Mengambil data dari tabel supplier
        $suppliers = Supplier::all(); 
        return view('data_master.supplier.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'kontak' => 'nullable|string',
        ]);

        Supplier::create($request->all());

        return redirect()->route('supplier.index')->with('success', 'Data Supplier berhasil masuk list! 🚚');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
        ]);

        $supplier = Supplier::findOrFail($id);
        $supplier->update($request->all());

        return redirect()->route('supplier.index')->with('success', 'Data supplier berhasil diupdate!');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('supplier.index')->with('success', 'Supplier berhasil dihapus!');
    }

    public function exportExcel() 
    {
        return Excel::download(new SupplierExport, 'Laporan_Supplier_Macrame.xlsx');
    }

    public function exportPdf() 
    {
        $suppliers = Supplier::all();
        $pdf = Pdf::loadView('pdf.supplier', compact('suppliers'));
        return $pdf->stream('Laporan_Supplier_Macrame.pdf');
    }
}