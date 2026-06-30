<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Atur Ulang Password | Rilla-Stock</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/css/tabler.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
    
    <style>
        body {
            background-color: #fdf8f3;
            background-image: url("https://www.transparenttextures.com/patterns/natural-paper.png");
        }
        .card-login {
            border-radius: 20px;
            border: none;
            box-shadow: 0 10px 25px rgba(186, 151, 120, 0.2);
        }
        .btn-primary {
            background-color: #ba9778 !important;
            border-color: #ba9778 !important;
        }
        .btn-primary:hover {
            background-color: #a38265 !important;
        }
        .text-accent {
            color: #ba9778;
        }
    </style>
</head>
<body class="d-flex flex-column">
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="text-center mb-4">
                <a href="#" class="navbar-brand navbar-brand-autodark">
                    <img src="{{ asset('assets/images/rillacumacrame.png') }}" height="120" alt="Rilla Logo" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
                </a>
            </div>

            <div class="card card-md card-login">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4" style="color: #6d4c41;">Buat Password Baru ✨</h2>
                    <p class="text-center text-muted mb-4">Masukkan password baru kamu yang aman dan mudah diingat.</p>

                    @if (session('error'))
                        <div class="alert alert-danger border-0 mb-4 text-center" style="background-color: #ffebee; color: #c62828; border-radius: 10px;">
                            <i class="ti ti-circle-x me-2"></i> {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}" autocomplete="off" novalidate>
                        @csrf

                        <input type="hidden" name="token" value="{{ $token ?? request()->route('token') }}">

                        <div class="mb-3">
                            <label class="form-label">Konfirmasi Alamat Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email', $email ?? request()->email) }}" required readonly>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="minimal 8 karakter..." required autofocus>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Ulangi Password Baru</label>
                            <input type="password" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="ketik ulang password..." required>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="ti ti-shield-check me-2"></i> Simpan & Perbarui Password
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="text-center text-muted mt-3">
                Dibuat dengan ❤️ oleh <strong>Rillacumacrame</strong>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
</body>
</html>