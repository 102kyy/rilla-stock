<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reset Password Rilla Stock</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background-color: #f8f5f2; color: #4e342e; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 30px auto; background: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(186, 151, 120, 0.15); border: 1px solid #ede1d5; }
        .header { background-color: #fffaf5; padding: 30px 20px; text-align: center; border-bottom: 3px solid #ba9778; }
        .header h1 { color: #6d4c41; margin: 0; font-size: 24px; }
        .body { padding: 30px 40px; line-height: 1.6; }
        .btn-reset { display: inline-block; background-color: #ba9778; color: #ffffff !important; text-decoration: none; padding: 12px 30px; border-radius: 8px; font-weight: 600; margin: 20px 0; }
        .footer { background-color: #fffaf5; padding: 20px; text-align: center; font-size: 12px; color: #a1887f; border-top: 1px solid #ede1d5; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Rilla Stock</h1>
        </div>
        <div class="body">
            <h3>Halo!</h3>
            <p>Kamu menerima email ini karena kami menerima permintaan atur ulang (reset) password untuk akun Rilla Stock kamu.</p>
            <div style="text-align: center; margin: 30px 0;">
                <a href="{{ route('password.custom_reset', ['token' => $token, 'email' => $email]) }}" 
                style="background-color: #ba9778; color: white; padding: 12px 24px; text-decoration: none; border-radius: 10px; font-weight: bold; display: inline-block;">
                    Reset Password Saya
                </a>
            </div>
            <p>Link tautan reset password ini akan kedaluwarsa dalam 60 menit. Jika kamu tidak merasa melakukan permintaan ini, abaikan saja email ini.</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Rillakumacrame. All Rights Reserved.</p>
        </div>
    </div>
</body>
</html>