<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Inventaris - Rillacumacrame</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            color: #333333;
            background-color: #FFFFFF;
            margin: 25px;
            padding: 0;
        }
        .header-section {
            margin-bottom: 40px;
        }
        .title-main {
            font-size: 20pt;
            font-weight: 700;
            color: #111111;
            margin: 0;
        }
        .title-sub {
            font-size: 10pt;
            color: #666666;
            margin-top: 5px;
            margin-bottom: 0;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .meta-block {
            font-size: 9pt;
            color: #999999;
            margin-top: 20px;
            border-top: 1px solid #EEEEEE;
            padding-top: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            font-size: 9pt;
            font-weight: 600;
            color: #777777;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 12px 8px;
            border-bottom: 2px solid #111111;
            text-align: left;
        }
        td {
            padding: 16px 8px;
            font-size: 10pt;
            border-bottom: 1px solid #F0F0F0;
            color: #333333;
        }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        
        .fw-bold { font-weight: 600; }
        
        .total-box-row td {
            font-size: 11pt;
            font-weight: 700;
            color: #111111;
            border-bottom: 2px solid #111111;
            padding-top: 20px;
            padding-bottom: 20px;
        }
    </style>
</head>
<body>

    <div class="header-section">
        <h1 class="title-main">Rillacumacrame</h1>
        <p class="title-sub">Inventory Master Report &bull; Produk Aktif</p>
        <div class="meta-block">
            Tanggal Dokumen: <?php echo e(date('d/m/Y')); ?> &bull; Rilla-Stock Inventory System
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 6%" class="text-center">No</th>
                <th style="width: 44%">Deskripsi Produk</th>
                <th style="width: 20%">Kategori</th>
                <th style="width: 15%" class="text-right">Harga Satuan</th>
                <th style="width: 15%" class="text-center">Stok</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalStok = 0; ?>
            <?php $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php $totalStok += $p->stok_akhir; ?>
            <tr>
                <td class="text-center" style="color: #999999;"><?php echo e($index + 1); ?></td>
                <td class="fw-bold"><?php echo e($p->nama_produk); ?></td>
                <td><?php echo e($p->kategori ? $p->kategori->nama_kategori : '-'); ?></td>
                <td class="text-right">Rp <?php echo e(number_format($p->harga, 0, ',', '.')); ?></td>
                <td class="text-center fw-bold"><?php echo e($p->stok_akhir); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
            <tr class="total-box-row">
                <td colspan="3" class="text-center">TOTAL UNIT STOK</td>
                <td colspan="2" class="text-center"><?php echo e($totalStok); ?> Pcs</td>
            </tr>
        </tbody>
    </table>

</body>
</html><?php /**PATH C:\laragon\www\rilla-stock\resources\views/pdf/produk.blade.php ENDPATH**/ ?>