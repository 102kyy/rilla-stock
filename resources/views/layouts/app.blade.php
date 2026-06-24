<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | Rilla-Stock</title>
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <style>
        /* Tambahan biar estetik sesuai brand Rilla-Stock kamu */
        .swal2-popup { border-radius: 15px !important; }
    </style>
    @stack('styles')
</head>
<body class="d-flex flex-column">
    <div class="page">
        @include('layouts.sidebar')
        <div class="page-wrapper">
            @include('layouts.header')
            
            @yield('content')
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Notifikasi Sukses (Tambah/Edit/Hapus)
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{!! session('success') !!}",
                    timer: 2000,
                    showConfirmButton: false,
                    background: '#fffaf5', 
                    iconColor: '#ba9778'   
                });
            @endif

            // Notifikasi Error
            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Waduh...',
                    text: "{!! session('error') !!}",
                    confirmButtonColor: '#d33',
                    background: '#fffaf5'
                });
            @endif
        });
    </script>

    @stack('scripts')
</body>
</html>