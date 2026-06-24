<!DOCTYPE html>
<html>
<head>
    <title>Laporan Logistik Bahan Baku</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #6d4c41; }
        .header p { margin: 5px 0 0 0; color: #666; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #b0b0b0; padding: 8px; text-align: left; }
        th { background-color: #fffaf5; color: #6d4c41; font-weight: bold; text-align: center; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
    </style>
</head>
<body>

    <div class="header">
        <h2>RILLACUMACRAME</h2>
        <p>Laporan Data Master - Logistik Bahan Baku Gudang</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th>Nama Bahan Baku</th>
                <th>Supplier Asal</th>
                <th width="15%">Stok Gudang</th>
                <th>Harga Beli Satuan</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($bahanBaku as $bb)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td><strong>{{ $bb->nama_bahan }}</strong></td>
                <td>{{ $bb->supplier->nama_supplier }}</td>
                <td class="text-center">{{ $bb->stok_bahan }} {{ $bb->satuan }}</td>
                <td class="text-right">Rp {{ number_format($bb->harga_beli, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">Belum ada data bahan baku.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>