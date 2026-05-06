<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    protected $table = 'soal';

    // Pastikan semua kolom ini terdaftar agar bisa disimpan ke database
    protected $fillable = [
        'pertanyaan',
        'kategori',
        'fase',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'kunci_jawaban',
        'status_validasi',
    ];
}