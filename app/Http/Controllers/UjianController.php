<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\HasilBelajar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
    /**
     * Menampilkan daftar soal pre-test
     */
    public function index()
    {
        $daftarSoal = Soal::where('status_validasi', true)
                          ->inRandomOrder()
                          ->limit(20)
                          ->get();

        if ($daftarSoal->isEmpty()) {
            return redirect()->route('siswa.dashboard')
                             ->with('error', 'Belum ada misi tersedia saat ini.');
        }

        return view('siswa.pretest', compact('daftarSoal'));
    }

    /**
     * Menyimpan jawaban pre-test (Form Submit)
     */
    public function simpanJawaban(Request $request)
    {
        $jawabanSiswa = $request->input('jawaban', []);
        $benar = 0;

        $idSoal = array_keys($jawabanSiswa);
        $semuaSoal = Soal::whereIn('id', $idSoal)->get();
        $totalSoal = $semuaSoal->count();

        if ($totalSoal > 0) {
            foreach ($semuaSoal as $soal) {
                if (isset($jawabanSiswa[$soal->id]) && $jawabanSiswa[$soal->id] == $soal->kunci_jawaban) {
                    $benar++;
                }
            }
            $skor = ($benar / $totalSoal) * 100;
        } else {
            $skor = 0;
        }

        // Simpan atau Update hasil ke database
        HasilBelajar::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'skor_pretest' => round($skor),
                // Gunakan DB::raw untuk menambah XP yang sudah ada di database tanpa menimpanya
                'total_xp' => DB::raw("total_xp + " . ($benar * 10))
            ]
        );

        return view('siswa.hasil', compact('skor', 'benar', 'totalSoal'));
    }

    /**
     * Simpan Skor Game (AJAX/Fetch API)
     */
    public function saveScore(Request $request)
    {
        // Validasi input agar tidak ada data sampah masuk
        $validated = $request->validate([
            'score' => 'required|integer|min:0',
            'type' => 'required|string|in:literasi,numerasi'
        ]);

        try {
            $user_id = Auth::id();

            // Cari data lama, atau siapkan data baru jika user belum pernah punya record
            $hasil = HasilBelajar::firstOrNew(['user_id' => $user_id]);

            // Update skor spesifik berdasarkan tipe game
            if ($validated['type'] == 'literasi') {
                $hasil->skor_game_literasi += $validated['score'];
            } else {
                $hasil->skor_game_numerasi += $validated['score'];
            }

            // Tambahkan ke total XP global
            $hasil->total_xp += $validated['score'];
            $hasil->save();

            return response()->json([
                'success' => true,
                'message' => 'Hebat! Skor ' . $validated['type'] . ' berhasil disimpan.',
                'new_xp' => $hasil->total_xp
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menyimpan skor: ' . $e->getMessage()
            ], 500);
        }
    }
}
