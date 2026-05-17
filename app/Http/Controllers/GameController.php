<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Soal;
use App\Models\HasilBelajar;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB; // Tambahan untuk mempermudah logging jika terjadi crash

class GameController extends Controller
{
    /**
     * Menampilkan halaman utama Arena Game (Index)
     */
    public function index()
    {
        return view('siswa.game.index');
    }

    /**
     * Memulai permainan berdasarkan tipe (Literasi / Numerasi) + Otomatis Filter Fase Siswa
     */
    public function play($tipe)
    {
        // 1. Validasi tipe game
        if (!in_array($tipe, ['literasi', 'numerasi'])) {
            return redirect()->route('siswa.game.index')->with('error', 'Gerbang game tidak ditemukan!');
        }

        // 2. Ambil data fase dari siswa yang sedang aktif login
        $userActive = Auth::user();
        $faseSiswa  = $userActive->fase ?? 'A'; // Default fallback ke Fase A jika data kosong

        // 3. Ambil 15 soal secara acak berdasarkan Tipe DAN Fase perkembangan kognitif siswa
        $daftarSoal = Soal::where('tipe', $tipe)
                            ->where('fase', $faseSiswa) // Mengunci agar soal sesuai tingkatan kelas siswa
                            ->inRandomOrder()
                            ->take(15)
                            ->get();

        // Jika bank soal belum diisi/kosong, beri pengaman agar tidak error
        if ($daftarSoal->isEmpty()) {
            return redirect()->route('siswa.game.index')->with('error', "Bank soal {$tipe} untuk Fase {$faseSiswa} belum tersedia.");
        }

        // 4. Arahkan ke view game masing-masing dengan membawa data soal acak dan informasi fase
        return view('siswa.game.' . $tipe, compact('daftarSoal', 'tipe', 'faseSiswa'));
    }

    /**
     * Menyimpan hasil skor game ke tabel belajar siswa (Proteksi Try-Catch Anti-Crash 500 Kosong)
     */
    public function simpanSkor(Request $request)
    {
        try {
            // 1. Validasi input dari Fetch API game
            $request->validate([
                'tipe'       => 'required|in:literasi,numerasi',
                'skor'       => 'required|integer|min:0|max:100',
                'waktu_sisa' => 'required|integer'
            ]);
    
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'Sesi login habis!'], 401);
            }
    
            // 2. Tentukan kolom mana yang akan diisi secara dinamis berdasarkan tipe game
            $kolomSkor = $request->tipe === 'literasi' ? 'skor_game_literasi' : 'skor_game_numerasi';
    
            // 3. Update atau Create data berdasarkan user_id siswa yang sedang aktif
            $progress = HasilBelajar::updateOrCreate(
                [
                    'user_id' => $user->id, // Mengunci baris data milik siswa ini
                ],
                [
                    $kolomSkor   => $request->skor, // Mengisi skor_game_literasi ATAU skor_game_numerasi
                    'updated_at' => now()
                ]
            );
    
            return response()->json([
                'success' => true,
                'message' => 'Skor petualangan game berhasil disimpan ke progres belajar!',
                'data'    => $progress
            ], 200);
    
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal simpan skor: ' . $e->getMessage()
            ], 500);
        }
    }
}
