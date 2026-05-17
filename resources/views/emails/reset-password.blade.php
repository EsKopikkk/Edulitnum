<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; background-color: #f5f5f5; }
        .email-container { max-width: 600px; margin: 0 auto; background-color: white; padding: 20px; border-radius: 10px; }
        .header { background-color: #E87F24; color: white; padding: 20px; text-align: center; border-radius: 10px 10px 0 0; }
        .content { padding: 20px; }
        .button { display: inline-block; background-color: #E87F24; color: white; padding: 12px 30px; text-decoration: none; border-radius: 5px; margin: 20px 0; }
        .footer { text-align: center; padding: 20px; font-size: 12px; color: #666; border-top: 1px solid #eee; }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>Reset Password Edulitnum</h1>
        </div>
        <div class="content">
            <p>Halo {{ $user->name }},</p>

            <p>Kami menerima permintaan untuk reset password akun Anda. Klik tombol di bawah untuk membuat password baru:</p>

            <center>
                <a href="{{ route('password.reset', ['token' => $token, 'email' => $user->email]) }}" class="button">
                    RESET PASSWORD
                </a>
            </center>

            <p>Atau copy dan paste URL ini ke browser Anda:</p>
            <p style="word-break: break-all;">{{ route('password.reset', ['token' => $token, 'email' => $user->email]) }}</p>

            <p style="color: #ff0000; font-weight: bold;">
                ⚠️ Link ini hanya berlaku selama 1 jam. Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini.
            </p>

            <p>Salam,<br>Tim Edulitnum</p>
        </div>
        <div class="footer">
            <p>© 2026 EDULITNUM ECOSYSTEM • BY EDULTIM24</p>
        </div>
    </div>
</body>
</html>
