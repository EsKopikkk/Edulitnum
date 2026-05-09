<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal'; // Pastikan nama tabelnya benar

    protected $fillable = [
        'modul_id', // WAJIB ADA
        'pertanyaan', 
        'pilihan_a', 
        'pilihan_b', 
        'pilihan_c', 
        'pilihan_d', 
        'kunci_jawaban', 
        'kategori', 
        'fase'
    ];

    // INI DIA "PINTU" YANG WAJIB ADA
    public function modul()
    {
        return $this->belongsTo(Modul::class, 'modul_id');
    }
}