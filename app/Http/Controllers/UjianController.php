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
     * Menyimpan jawaban pre-test (Form Submit) dengan Logika Kecepatan Waktu
     */
    public function simpanJawaban(Request $request)
    {
        $jawabanSiswa = $request->input('jawaban', []);
        $sisaWaktuSiswa = $request->input('sisa_waktu', []); // Tangkap array sisa waktu dari blade

        $idSoal = array_keys($jawabanSiswa);
        $semuaSoal = Soal::whereIn('id', $idSoal)->get();
        $totalSoal = $semuaSoal->count();

        $totalSkorMaksimal = 0;
        $skorDidapat = 0;
        $benar = 0;

        if ($totalSoal > 0) {
            // Kita tentukan bobot dasar per soal jika dijawab benar (misal max 100 poin per soal)
            $bobotDasarSoal = 100;

            foreach ($semuaSoal as $soal) {
                $totalSkorMaksimal += $bobotDasarSoal;

                // Cek apakah jawaban siswa ada dan benar
                if (isset($jawabanSiswa[$soal->id]) && $jawabanSiswa[$soal->id] == $soal->kunci_jawaban) {
                    $benar++;

                    // Ambil sisa waktu soal ini dari form (default 30 detik kalau tidak terekam)
                    $sisaWaktu = isset($sisaWaktuSiswa[$soal->id]) ? intval($sisaWaktuSiswa[$soal->id]) : 30;
                    $waktuMenjawab = 30 - $sisaWaktu; // Berapa detik yang dihabiskan siswa

                    if ($waktuMenjawab <= 5) {
                        // 5 detik pertama -> Nilai FULL (100%)
                        $poinSoal = $bobotDasarSoal;
                    } else {
                        // Lewat 5 detik -> Dikurangi tipis (0.5% per detik).
                        // Detik ke-30 terpotong maksimal 12.5%, sisa nilai minimum tetap 87.5% (tidak anjlok signifikan)
                        $faktorPengurang = 1 - (($waktuMenjawab - 5) * 0.005);
                        $poinSoal = $bobotDasarSoal * max($faktorPengurang, 0.85);
                    }

                    $skorDidapat += $poinSoal;
                }
            }

            // Skala konversi akhir menjadi 0 - 100
            $skor = ($skorDidapat / $totalSkorMaksimal) * 100;
        } else {
            $skor = 0;
        }

        // Simpan atau Update hasil ke database
        HasilBelajar::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'skor_pretest' => round($skor),
                // XP bertambah berdasarkan jumlah jawaban benar dikali 10
                'total_xp' => DB::raw("total_xp + " . ($benar * 10))
            ]
        );

        // Mengarah ke file hasil.blade.php yang sudah kita perbaiki tampilannya tadi
        return view('siswa.hasil', compact('skor', 'benar', 'totalSoal'));
    }

    /**
     * Simpan Skor Game (AJAX/Fetch API)
     */
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
