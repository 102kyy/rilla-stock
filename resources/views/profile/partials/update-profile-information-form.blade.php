<section>
    <header class="mb-3">
        <h3 class="h4 mb-1" style="color: #6d4c41; font-weight: 600;">Informasi Profil</h3>
        <p class="text-muted small">Perbarui informasi nama lengkap dan alamat email akun Anda di sini.</p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-3">
        @csrf
        @method('patch')

        <!-- Status Alert Success -->
        @if (session('status') === 'profile-updated')
            <div class="alert alert-success alert-dismissible rounded-3 mb-3" role="alert" style="background: #f4fbf7; border-color: #ccecdb; color: #1e663e;">
                <div>✨ Profil kamu berhasil diperbarui dengan rapi!</div>
            </div>
        @endif

        <!-- Input Nama -->
        <div class="mb-3">
            <label class="form-label small fw-bold text-muted mb-1">Nama Lengkap</label>
            <input type="text" name="name" class="form-control rounded-3 @error('name') is-invalid @enderror" 
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                   style="border-color: #ebdcd0; background-color: #fffdfb;">
            @error('name')
                <div class="invalid-feedback small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input Email -->
        <div class="mb-3">
            <label class="form-label small fw-bold text-muted mb-1">Alamat Email</label>
            <input type="email" name="email" class="form-control rounded-3 @error('email') is-invalid @enderror" 
                   value="{{ old('email', $user->email) }}" required autocomplete="username"
                   style="border-color: #ebdcd0; background-color: #fffdfb;">
            @error('email')
                <div class="invalid-feedback small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Simpan -->
        <div class="d-flex align-items-center gap-3 pt-2">
            <button type="submit" class="btn text-white rounded-3 px-4 shadow-sm" 
                    style="background: linear-gradient(135deg, #ba9778, #6d4c41); border: none; font-weight: 600;">
                <i class="ti ti-device-floppy me-2"></i>Simpan Perubahan
            </button>
        </div>
    </form>
</section>