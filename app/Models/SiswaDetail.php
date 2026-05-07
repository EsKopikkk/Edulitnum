<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiswaDetail extends Model
{
    protected $table = 'siswa_detail'; // Pastikan nama tabel sesuai SRS 
    
    protected $fillable = [
        'user_id',
        'kelas_id',
    ];

    // Relasi kembali ke Kelas
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}