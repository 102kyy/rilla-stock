<!DOCTYPE html>
<html>
<head>
    <title>Laporan Daftar Supplier</title>
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
        <p>Laporan Data Master - Mitra Supplier Tali & Bahan Baku</p>
    </div>

    <table>
        <thead>
            <tr>
                <th width="8%">No</th>
                <th width="30%">Nama Supplier</th>
                <th width="22%">No. Telepon / WA</th>
                <th>Alamat Lengkap</th>
            </tr>
        </thead>
        <tbody>
            @php $no = 1; @endphp
            @forelse($suppliers as $supplier)
            <tr>
                <td class="text-center">{{ $no++ }}</td>
                <td><strong>{{ $supplier->nama_supplier }}</strong></td>
                <td>{{ $supplier->kontak ?? '-' }}</td> 
                <td>{{ $supplier->alamat ?? '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center">Belum ada data supplier yang terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>