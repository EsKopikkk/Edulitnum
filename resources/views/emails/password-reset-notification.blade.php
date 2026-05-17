<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Baru - Edulitnum</title>
    <style>
        body { font-family: 'Poppins', sans-serif; line-height: 1.6; color: #333; background-color: #f5f5f5; }
        .container { max-width: 600px; margin: 0 auto; background: white; padding: 40px; border-radius: 20px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); }
        .header { text-align: center; margin-bottom: 30px; border-bottom: 3px solid #E87F24; padding-bottom: 20px; }
        .logo { font-size: 32px; font-weight: bold; color: #E87F24; }
        .content { margin: 30px 0; }
        .greeting { font-size: 18px; font-weight: bold; color: #1A202C; margin-bottom: 15px; }
        .password-box { background: linear-gradient(135deg, #E87F24 0%, #FFC81E 100%); color: white; padding: 20px; border-radius: 12px; text-align: center; margin: 20px 0; font-size: 18px; font-weight: bold; font-family: 'Courier New', monospace; }
        .instruction { background: #f0f0f0; padding: 15px; border-radius: 8px; margin: 15px 0; border-left: 4px solid #73A5CA; }
        .instruction strong { color: #73A5CA; }
        .warning { background: #fff3cd; padding: 15px; border-radius: 8px; margin: 15px 0; border-left: 4px solid #FFC81E; color: #856404; font-size: 14px; }
        .footer { text-align: center; margin-top: 40px; padding-top: 20px; border-top: 1px solid #ddd; color: #666; font-size: 12px; }
        .button { display: inline-block; background: #E87F24; color: white; padding: 12px 30px; text-decoration: none; border-radius: 8px; margin: 20px 0; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">🎓 EDULITNUM</div>
            <p style="margin: 10px 0 0 0; color: #E87F24; font-weight: 600;">Platform Pembelajaran Interaktif</p>
        </div>

        <div class="content">
            <div class="greeting">Halo {{ $user->name }},</div>

            <p>Password akun Anda telah direset oleh Admin. Berikut adalah password baru Anda:</p>

            <div class="password-box">
                {{ $newPassword }}
            </div>

            <div class="instruction">
                <strong>📋 Langkah-langkah Login:</strong>
                <ol style="margin: 10px 0; padding-left: 20px;">
                    <li>Buka halaman login Edulitnum</li>
                    <li>Masukkan nama lengkap Anda</li>
                    <li>Masukkan password baru di atas</li>
                    <li>Pilih "Guru" atau "Admin" sesuai role Anda</li>
                    <li>Klik "MASUK SEKARANG"</li>
                </ol>
            </div>

            <div class="warning">
                ⚠️ <strong>Keamanan:</strong>
                <br>• Jangan bagikan password ini kepada siapapun
                <br>• Segera ubah password Anda setelah login untuk alasan keamanan
                <br>• Jika Anda tidak melakukan reset ini, hubungi admin segera
            </div>

            <p style="margin-top: 20px;">Jika ada pertanyaan, hubungi Tim Support Edulitnum.</p>
        </div>

        <div class="footer">
            <p>© 2026 EDULITNUM ECOSYSTEM • BY EDULTIM24</p>
            <p>Email ini dikirim otomatis. Mohon tidak membalas email ini.</p>
        </div>
    </div>
</body>
</html>
