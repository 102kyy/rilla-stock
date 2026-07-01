<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Rilla-Stock</title>
    <!-- Tabler Core CSS -->
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
            background-color: #ba9778 !important; /* Warna cokelat tali katun */
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
                    <!-- Memanggil Logo Rillacumacrame -->
                    <img src="{{ asset('assets/images/rillacumacrame.png') }}" height="120" alt="Rilla Logo" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
                </a>
            </div>

            <div class="card card-md card-login">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4" style="color: #6d4c41;">Selamat Datang Kembali! ✨</h2>
                    <p class="text-center text-muted mb-4">Silakan login untuk memantau stok kerajinan cantik kamu.</p>
                    
                    <!-- Session Status -->
                    <x-auth-session-status class="mb-4 text-success" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}" autocomplete="off" novalidate>
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="masukkan email..." value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                                {{-- <span class="form-label-description">
                                    @if (Route::has('password.request'))
                                        <a href="{{ route('password.request') }}" class="text-accent">Lupa password?</a>
                                    @endif
                                </span> --}}
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="masukkan password..." required>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="mb-3">
                            <label class="form-check">
                                <input type="checkbox" name="remember" class="form-check-input" />
                                <span class="form-check-label">Ingat saya di perangkat ini</span>
                            </label>
                        </div>

                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                <i class="ti ti-login me-2"></i> Masuk ke Dashboard
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

    <!-- Tabler Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/@tabler/core@1.0.0-beta17/dist/js/tabler.min.js"></script>
</body>
</html>