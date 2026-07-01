<div class="mb-3">
    <label class="form-label fw-bold">Role Hak Akses</label>
    <select name="role" class="form-select" required>
        <option value="pegawai" <?php echo e($pegawai->role === 'pegawai' ? 'selected' : ''); ?>>Pegawai (Hanya Transaksi & Laporan)</option>
        <option value="admin" <?php echo e($pegawai->role === 'admin' ? 'selected' : ''); ?>>Admin (Semua Akses & Master Data)</option>
    </select>
</div><?php /**PATH C:\laragon\www\rilla-stock\resources\views/management-usr/permission.blade.php ENDPATH**/ ?>