<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $__env->yieldContent('title'); ?> | Rilla-Stock</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <style>
        /* Tambahan biar estetik sesuai brand Rilla-Stock kamu */
        .swal2-popup { border-radius: 15px !important; }
    </style>
    <?php echo $__env->yieldPushContent('styles'); ?>
</head>
<body class="d-flex flex-column">
    <div class="page">
        <?php echo $__env->make('layouts.sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="page-wrapper">
            <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            
            <?php echo $__env->yieldContent('content'); ?>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Notifikasi Sukses (Tambah/Edit/Hapus)
            <?php if(session('success')): ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "<?php echo session('success'); ?>",
                    timer: 2000,
                    showConfirmButton: false,
                    background: '#fffaf5', 
                    iconColor: '#ba9778'   
                });
            <?php endif; ?>

            // Notifikasi Error
            <?php if(session('error')): ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Waduh...',
                    text: "<?php echo session('error'); ?>",
                    confirmButtonColor: '#d33',
                    background: '#fffaf5'
                });
            <?php endif; ?>
        });
    </script>

    <?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\laragon\www\rilla-stock\resources\views/layouts/app.blade.php ENDPATH**/ ?>