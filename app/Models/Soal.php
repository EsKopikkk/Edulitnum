<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// 1. Panggil Modul-nya di sini biar Soal kenal
use App\Models\Modul; 

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $fillable = [
        'modul_id',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'kunci_jawaban',
        'kategori',
        'fase'
    ];

    // 2. Tulis relasinya jadi simpel begini
    public function modul()
    {
        return $this->belongsTo(Modul::class, 'modul_id');
    }
}