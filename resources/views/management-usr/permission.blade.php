<div class="mb-3">
    <label class="form-label fw-bold">Role Hak Akses</label>
    <select name="role" class="form-select" required>
        <option value="pegawai" {{ $pegawai->role === 'pegawai' ? 'selected' : '' }}>Pegawai (Hanya Transaksi & Laporan)</option>
        <option value="admin" {{ $pegawai->role === 'admin' ? 'selected' : '' }}>Admin (Semua Akses & Master Data)</option>
    </select>
</div>