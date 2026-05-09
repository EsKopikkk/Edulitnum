<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Modul;

class Soal extends Model
{
    use HasFactory;

    protected $table = 'soal';

    protected $fillable = [
        'modul_id',
        'pertanyaan',
        'kategori',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'kunci_jawaban',
        'status_validasi',
        'fase'
    ];

    // Relasi ke Modul (Wajib di dalam kurung kurawal class)
    public function modul()
    {
        return $this->belongsTo(Modul::class, 'modul_id');
    }
}