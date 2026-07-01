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
                    <img src="<?php echo e(asset('assets/images/rillacumacrame.png')); ?>" height="120" alt="Rilla Logo" style="filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));">
                </a>
            </div>

            <div class="card card-md card-login">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4" style="color: #6d4c41;">Selamat Datang Kembali! ✨</h2>
                    <p class="text-center text-muted mb-4">Silakan login untuk memantau stok kerajinan cantik kamu.</p>
                    
                    <!-- Session Status -->
                    <?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-4 text-success','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-4 text-success','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>

                    <form method="POST" action="<?php echo e(route('login')); ?>" autocomplete="off" novalidate>
                        <?php echo csrf_field(); ?>

                        <!-- Email Address -->
                        <div class="mb-3">
                            <label class="form-label">Alamat Email</label>
                            <input type="email" name="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="masukkan email..." value="<?php echo e(old('email')); ?>" required autofocus>
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Password -->
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                                
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" name="password" class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" placeholder="masukkan password..." required>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="invalid-feedback"><?php echo e($message); ?></div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
</html><?php /**PATH C:\laragon\www\rilla-stock\resources\views/auth/login.blade.php ENDPATH**/ ?>