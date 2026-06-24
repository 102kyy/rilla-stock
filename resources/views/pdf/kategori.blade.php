<!DOCTYPE html>
<html>
<head>
    <title>Laporan Kategori Produk Macramé</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; color: #333; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h2 { margin: 0; color: #6d4c41; }
        .header p { margin: 5px 0 0 0; color: #666; font-size: 11px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #b0b0b0; padding: 8px; text-align: left; }
        th { background-color: #fffaf5; color: #6d4c41; font-weight: bold; text-align: center; }
        .text-center { text-align: center; }
    </style>
</head>
<body>

    <div class="header">
        <h2>RILLACUMACRAME</h2>
        <p>Laporan Data Master - Kategori Produk Macramé</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="8%">No</th>
                <th>Nama Kategori</th>
                <th width="25%">Total Stok Produk</th>
                <th width="20%">Status</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($kategoris as $kategori)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td><strong>{{ $kategori->nama_kategori }}</strong></td>
                <td class="text-center">{{ $kategori->produks_sum_stok_akhir ?? 0 }} Pcs</td>
                <td class="text-center">{{ ucfirst($kategori->status) }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data kategori.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>