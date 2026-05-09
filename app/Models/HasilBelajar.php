<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilBelajar extends Model
{
    protected $table = 'hasil_belajars';

    protected $fillable = [
        'user_id',
        'skor_pretest',
        'skor_game_literasi',
        'skor_game_numerasi',
        'total_xp'
    ];
}
