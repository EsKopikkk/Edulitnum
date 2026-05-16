<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\HasilBelajar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UjianController extends Controller
{
    // Menampilkan daftar soal pre-test
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

    // Menyimpan jawaban pre-test dan kalkulasi skor berdasarkan kecepatan waktu
    public function simpanJawaban(Request $request)
    {
        $jawabanSiswa = $request->input('jawaban', []);
        $sisaWaktuSiswa = $request->input('sisa_waktu', []);

        $idSoal = array_keys($jawabanSiswa);
        $semuaSoal = Soal::whereIn('id', $idSoal)->get();
        $totalSoal = $semuaSoal->count();

        $totalSkorMaksimal = 0;
        $skorDidapat = 0;
        $benar = 0;

        if ($totalSoal > 0) {
            $bobotDasarSoal = 100;

            foreach ($semuaSoal as $soal) {
                $totalSkorMaksimal += $bobotDasarSoal;

                if (isset($jawabanSiswa[$soal->id]) && $jawabanSiswa[$soal->id] == $soal->kunci_jawaban) {
                    $benar++;

                    $sisaWaktu = isset($sisaWaktuSiswa[$soal->id]) ? intval($sisaWaktuSiswa[$soal->id]) : 30;
                    $waktuMenjawab = 30 - $sisaWaktu;

                    // Logika Bonus Waktu: 5 detik pertama full, setelahnya penyusutan linear konstan
                    if ($waktuMenjawab <= 5) {
                        $poinSoal = $bobotDasarSoal;
                    } else {
                        $faktorPengurang = 1 - (($waktuMenjawab - 5) * 0.005);
                        $poinSoal = $bobotDasarSoal * max($faktorPengurang, 0.85);
                    }

                    $skorDidapat += $poinSoal;
                }
            }

            $skor = ($skorDidapat / $totalSkorMaksimal) * 100;
        } else {
            $skor = 0;
        }

        // Menyimpan atau memperbarui akumulasi hasil belajar siswa
        HasilBelajar::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'skor_pretest' => round($skor),
                'total_xp' => DB::raw("total_xp + " . ($benar * 10))
            ]
        );

        // Mengunci status siswa agar tidak bisa mengakses halaman pre-test kembali
        $user = Auth::user();
        if ($user) {
            $user->is_pretest_done = true;
            /** @var \App\Models\User $user */
            $user->save();
        }

        return view('siswa.hasil', compact('skor', 'benar', 'totalSoal'));
    }

    // Menyimpan perolehan skor game via AJAX/Fetch API
    public function saveScore(Request $request)
    {
        $validated = $request->validate([
            'score' => 'required|integer|min:0',
            'type' => 'required|string|in:literasi,numerasi'
        ]);

        try {
            $user_id = Auth::id();
            $hasil = HasilBelajar::firstOrNew(['user_id' => $user_id]);

            if ($validated['type'] == 'literasi') {
                $hasil->skor_game_literasi += $validated['score'];
            } else {
                $hasil->skor_game_numerasi += $validated['score'];
            }

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
