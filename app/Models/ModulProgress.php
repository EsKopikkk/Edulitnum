<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ModulProgress extends Model
{
    protected $table = 'siswa_modul_progress';

    protected $fillable = ['user_id', 'modul_id', 'status', 'viewed_at', 'completed_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function modul()
    {
        return $this->belongsTo(Modul::class);
    }
}
