# Fitur Reset Password Guru

## 📋 Perubahan yang Dilakukan

### 1. **Login Page** (resources/views/auth/login.blade.php)
- Menambahkan link "Lupa Password?" di halaman login guru
- Link mengarah ke route `password.request`

### 2. **Forgot Password Page** (resources/views/auth/forgot-password.blade.php)
- Halaman untuk guru memasukkan email
- Form akan mengirim request ke route `password.email`
- Email guru harus terdaftar di sistem

### 3. **Reset Password Page** (resources/views/auth/reset-password.blade.php)
- Halaman untuk memasukkan password baru
- Menerima token dari URL sebagai parameter
- Form untuk input email, password baru, dan konfirmasi password

### 4. **Email Template** (resources/views/emails/reset-password.blade.php)
- Email berisi link untuk reset password
- Link valid selama 1 jam
- Format HTML yang menarik dengan branding Edulitnum

### 5. **Routes** (routes/auth.php)
- `GET /forgot-password` → Tampilkan halaman forgot password
- `POST /forgot-password` → Generate token dan kirim email
- `GET /reset-password/{token}` → Tampilkan halaman reset password
- `POST /reset-password` → Validasi token dan update password

## 🔧 Cara Kerja

### Flow Guru Lupa Password:

1. **Guru klik "Lupa Password?"** di halaman login
2. **Guru memasukkan email terdaftar** di halaman forgot-password
3. **Sistem generate token unik** dan simpan ke `password_reset_tokens` table
4. **Email dengan link reset dikirim** ke email guru
   - Link format: `https://domain.com/reset-password/{token}?email=guru@example.com`
5. **Guru klik link di email**
6. **Guru memasukkan password baru** dan konfirmasi
7. **Sistem validasi token** dan update password di database
8. **Token dihapus** dari database (tidak bisa digunakan lagi)
9. **Guru bisa login** dengan password baru

## 📧 Konfigurasi Email

Pastikan MAIL_FROM_ADDRESS dan MAIL_FROM_NAME sudah dikonfigurasi di .env:

```
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="noreply@edulitnum.com"
MAIL_FROM_NAME="Edulitnum"
```

## 🔒 Keamanan

- Token di-hash sebelum disimpan di database
- Token hanya valid selama 1 jam (created_at field)
- Email harus terdaftar di sistem
- Password minimal 8 karakter
- Password di-hash dengan bcrypt

## ⚠️ Catatan Penting

- Database table `password_reset_tokens` harus sudah ada (sudah ada di Laravel default)
- Jika belum ada, jalankan migration: `php artisan migrate`
- Email driver harus dikonfigurasi dengan benar
- Pastikan guru menggunakan email yang terdaftar di sistem
