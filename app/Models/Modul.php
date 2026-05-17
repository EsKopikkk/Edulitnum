<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;

    protected $fillable = ['kelas_id', 'judul', 'deskripsi', 'file_materi', 'gambar', 'gambar_konten'];

    // 1 Modul dimiliki oleh 1 Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    // 1 Modul punya banyak Soal
    public function soal()
    {
        return $this->hasMany(Soal::class);
    }

    public function modul()
{
    // Tambahkan \App\Models\ di depannya
    return $this->belongsTo(\App\Models\Modul::class, 'modul_id');
}
}