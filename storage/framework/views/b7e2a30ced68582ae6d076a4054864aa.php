<section>
    <header class="mb-3">
        <h3 class="h4 mb-1" style="color: #6d4c41; font-weight: 600;">Perbarui Kata Sandi</h3>
        <p class="text-muted small">Pastikan akun Anda menggunakan kata sandi yang panjang dan aman.</p>
    </header>

    <form method="post" action="<?php echo e(route('password.update')); ?>" class="space-y-3">
        <?php echo csrf_field(); ?>
        <?php echo method_field('put'); ?>

        <?php if(session('status') === 'password-updated'): ?>
            <div class="alert alert-success alert-dismissible rounded-3 mb-3" role="alert" style="background: #f4fbf7; border-color: #ccecdb; color: #1e663e;">
                <div>🔑 Kata sandi barumu sudah berhasil disimpan ya!</div>
            </div>
        <?php endif; ?>

        <div class="mb-3">
            <label class="form-label small fw-bold text-muted mb-1">Kata Sandi Saat Ini</label>
            <div class="input-group">
                <input type="password" id="current_password" name="current_password" class="form-control rounded-start-3 <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       autocomplete="current-password" style="border-color: #ebdcd0; background-color: #fffdfb;">
                <button class="btn btn-outline-light toggle-password rounded-end-3" type="button" data-target="current_password"
                        style="border: 1px solid #ebdcd0; border-left: none; background-color: #fffdfb; color: #ba9778;">
                    <i class="ti ti-eye"></i>
                </button>
            </div>
            <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small mt-1" style="font-size: 0.875em;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-muted mb-1">Kata Sandi Baru</label>
            <div class="input-group">
                <input type="password" id="password" name="password" class="form-control rounded-start-3 <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       autocomplete="new-password" style="border-color: #ebdcd0; background-color: #fffdfb;">
                <button class="btn btn-outline-light toggle-password rounded-end-3" type="button" data-target="password"
                        style="border: 1px solid #ebdcd0; border-left: none; background-color: #fffdfb; color: #ba9778;">
                    <i class="ti ti-eye"></i>
                </button>
            </div>
            <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small mt-1" style="font-size: 0.875em;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="mb-3">
            <label class="form-label small fw-bold text-muted mb-1">Konfirmasi Kata Sandi Baru</label>
            <div class="input-group">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control rounded-start-3 <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                       autocomplete="new-password" style="border-color: #ebdcd0; background-color: #fffdfb;">
                <button class="btn btn-outline-light toggle-password rounded-end-3" type="button" data-target="password_confirmation"
                        style="border: 1px solid #ebdcd0; border-left: none; background-color: #fffdfb; color: #ba9778;">
                    <i class="ti ti-eye"></i>
                </button>
            </div>
            <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="text-danger small mt-1" style="font-size: 0.875em;"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="d-flex align-items-center gap-3 pt-2">
            <button type="submit" class="btn text-white rounded-3 px-4 shadow-sm" 
                    style="background: linear-gradient(135deg, #ba9778, #6d4c41); border: none; font-weight: 600;">
                <i class="ti ti-key me-2"></i>Perbarui Sandi
            </button>
        </div>
    </form>
</section>

<script>
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', function () {
            const targetId = this.getAttribute('data-target');
            const input = document.getElementById(targetId);
            const icon = this.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('ti-eye');
                icon.classList.add('ti-eye-off');
            } else {
                input.type = 'password';
                icon.classList.remove('ti-eye-off');
                icon.classList.add('ti-eye');
            }
        });
    });
</script><?php /**PATH C:\laragon\www\rilla-stock\resources\views/profile/partials/update-password-form.blade.php ENDPATH**/ ?>