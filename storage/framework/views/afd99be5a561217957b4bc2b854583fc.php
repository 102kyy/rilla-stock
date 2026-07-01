<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Akun Rilla Stock Baru</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f5f2;
            color: #4e342e;
            margin: 0;
            padding: 0;
        }
        .email-container {
            max-width: 600px;
            margin: 30px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(186, 151, 120, 0.15);
            border: 1px solid #ede1d5;
        }
        .email-header {
            background-color: #fffaf5;
            padding: 30px 20px;
            text-align: center;
            border-bottom: 3px solid #ba9778;
        }
        .email-header h1 {
            color: #6d4c41;
            margin: 0;
            font-size: 24px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        .email-body {
            padding: 30px 40px;
            line-height: 1.6;
        }
        .email-body h3 {
            color: #6d4c41;
            margin-top: 0;
            font-size: 18px;
        }
        .account-box {
            background-color: #fffaf5;
            border-left: 4px solid #ba9778;
            padding: 20px;
            margin: 25px 0;
            border-radius: 0 12px 12px 0;
        }
        .account-details {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .account-details li {
            margin-bottom: 10px;
            font-size: 15px;
        }
        .account-details li:last-child {
            margin-bottom: 0;
        }
        .account-details strong {
            color: #6d4c41;
            display: inline-block;
            width: 80px;
        }
        .btn-login {
            display: inline-block;
            background-color: #ba9778;
            color: #ffffff !important;
            text-decoration: none;
            padding: 12px 30px;
            border-radius: 8px;
            font-weight: 600;
            margin: 15px 0;
            text-align: center;
        }
        .btn-login:hover {
            background-color: #5d4037;
        }
        .email-footer {
            background-color: #fffaf5;
            padding: 20px;
            text-align: center;
            font-size: 12px;
            color: #a1887f;
            border-top: 1px solid #ede1d5;
        }
        .note {
            font-size: 13px;
            color: #8d6e63;
            font-style: italic;
        }
    </style>
</head>
<body>

    <div class="email-container">
        <div class="email-header">
            <h1>Rilla Stock</h1>
        </div>
        <div class="email-body">
            <h3>Halo, <?php echo e($user->name); ?>!</h3>
            <p>Selamat bergabung! Akun Anda telah berhasil didaftarkan di sistem manajemen internal <strong>Rilla Stock</strong>.</p>
            <p>Gunakan detail akun di bawah ini untuk mengakses sistem:</p>
            
            <div class="account-box">
                <ul class="account-details">
                    <li><strong>Email:</strong> <?php echo e($user->email); ?></li>
                    <li><strong>Password:</strong> <span style="font-family: monospace; background: #e0d4c8; padding: 2px 6px; border-radius: 4px; font-weight: bold;"><?php echo e($password); ?></span></li>
                </ul>
            </div>

            <p class="note">*Demi keamanan data kerajinan dan stok macrame kita, mohon untuk segera mengganti password Anda setelah pertama kali login.</p>
            
            <div style="text-align: center; margin-top: 30px;">
                <a href="<?php echo e(url('/login')); ?>" class="btn-login">Masuk ke Aplikasi</a>
            </div>
        </div>
        <div class="email-footer">
            <p>Pemberitahuan otomatis oleh Sistem Inventaris Rilla Stock.<br>
            &copy; <?php echo e(date('Y')); ?> Rillakumacrame. All Rights Reserved.</p>
        </div>
    </div>

</body>
</html><?php /**PATH C:\laragon\www\rilla-stock\resources\views/mail/akun-baru.blade.php ENDPATH**/ ?>