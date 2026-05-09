<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\HasilBelajar;
use Illuminate\Support\Facades\Auth;

class UjianController extends Controller
{
    /**
     * Menampilkan daftar soal pre-test
     */
    public function index()
    {
        // Kita ambil soal yang sudah divalidasi guru
        // inRandomOrder() supaya urutan soal diacak setiap siswa buka halaman ini
        $daftarSoal = Soal::where('status_validasi', true)
                          ->inRandomOrder()
                          ->limit(20)
                          ->get();

        // Mengarahkan ke halaman view siswa.pretest
        return view('siswa.pretest', compact('daftarSoal'));
    }

    /**
     * Menyimpan jawaban siswa ke database
     */
    public function simpanJawaban(Request $request)
    {
        $jawabanSiswa = $request->input('jawaban', []);
        $skor = 0;
        $benar = 0;
    
        // Ambil semua soal untuk validasi kunci jawaban
        $semuaSoal = \App\Models\Soal::whereIn('id', array_keys($jawabanSiswa))->get();
        $totalSoal = $semuaSoal->count();
    
        if ($totalSoal > 0) {
            foreach ($semuaSoal as $soal) {
                if (isset($jawabanSiswa[$soal->id]) && $jawabanSiswa[$soal->id] == $soal->kunci_jawaban) {
                    $benar++;
                }
            }
            $skor = ($benar / $totalSoal) * 100;
        }
    
        return view('siswa.hasil', compact('skor', 'benar', 'totalSoal'));
    }
}
