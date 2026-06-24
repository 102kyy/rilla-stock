<!DOCTYPE html>
<html>
<head>
    <title>Laporan Arus Stok Rilla-Stock</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; }
        .header { text-align: center; margin-bottom: 25px; }
        .header h2 { margin: 0; color: #6d4c41; letter-spacing: 1px; }
        .header p { margin: 5px 0 0 0; color: #666; font-size: 11px; }
        .section-title { font-size: 13px; font-weight: bold; color: #6d4c41; margin-top: 20px; margin-bottom: 8px; border-left: 3px solid #ba9778; padding-left: 5px;}
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #b0b0b0; padding: 6px 8px; text-align: left; }
        th { background-color: #fffaf5; color: #6d4c41; font-weight: bold; text-align: center; }
        .text-center { text-align: center; }
        .text-success { color: #2fb344; font-weight: bold; }
        .text-danger { color: #d63939; font-weight: bold; }
    </style>
</head>
<body>

    <div class="header">
        <h2>RILLACUMACRAME</h2>
        <p>Laporan Transaksi Arus Stok Barang Masuk & Keluar</p>
        @if($tanggal_mulai && $tanggal_selesai)
            <p style="font-style: italic; color: #888;">Periode: {{ \Carbon\Carbon::parse($tanggal_mulai)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($tanggal_selesai)->format('d M Y') }}</p>
        @else
            <p style="font-style: italic; color: #888;">Periode: Semua Riwayat Transaksi</p>
        @endif
    </div>

    <div class="section-title">I. Riwayat Transaksi Stok Masuk</div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="18%">Tanggal</th>
                <th>Bahan Baku</th>
                <th width="18%">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @php $noMasuk = 1; @endphp
            @forelse($laporanMasuk as $masuk)
            <tr>
                <td class="text-center">{{ $noMasuk++ }}</td>
                <td>{{ \Carbon\Carbon::parse($masuk->tanggal_masuk)->format('d M Y') }}</td>
                <td><strong>{{ $masuk->bahanBaku->nama_bahan ?? 'Bahan Terhapus' }}</strong></td>
                <td class="text-center text-success">+ {{ $masuk->jumlah_masuk }} Pcs</td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="text-center" style="color: #999;">Tidak ada transaksi stok masuk.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">II. Riwayat Transaksi Stok Keluar</div>
    <table>
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="18%">Tanggal</th>
                <th>Bahan / Produk</th>
                <th>Keterangan Keperluan</th>
                <th width="18%">Jumlah</th>
            </tr>
        </thead>
       <tbody>
            @forelse($laporanKeluar as $key => $keluar)
            <tr>
                <td class="text-center">{{ $key + 1 }}</td>
               <td>{{ $keluar->created_at ? \Carbon\Carbon::parse($keluar->created_at)->format('d M Y') : \Carbon\Carbon::now()->format('d M Y') }}</td>
                <td class="fw-bold" style="color: #8d6e63;">{{ $keluar->produk->nama_produk ?? 'Produk Terhapus' }}</td> 
                <td>{{ $keluar->tujuan ?? 'Penjualan / Keperluan Lain' }}</td> 
                <td class="text-center fw-bold text-danger">- {{ $keluar->jumlah_keluar }} Pcs</td> 
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center py-4 text-muted italic">Tidak ada transaksi stok keluar dalam periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>