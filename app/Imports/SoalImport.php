<?php

namespace App\Imports;

use App\Models\Soal;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SoalImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // --- 1. TRIK PENGAMAN UTAMA (ANTI-CRASH) ---
        // Jika kolom 'modul_id' tidak ditemukan (akibat salah buka tab sheet / baris kosong di Excel),
        // langsung skip baris ini dengan mengembalikan nilai null agar sistem tidak melempar eror.
        if (!isset($row['modul_id']) && !isset($row['modulid'])) {
            return null; 
        }

        // --- 2. TOLERANSI FORMAT SLUG ---
        // Menampung variasi pembacaan key oleh Laravel Excel (bisa pakai atau tanpa underscore)
        $modulId      = $row['modul_id'] ?? $row['modulid'] ?? null;
        $pertanyaan   = $row['pertanyaan'] ?? null;
        $kategori     = $row['kategori'] ?? 'literasi';
        $fase         = $row['fase'] ?? 'a';
        $tipe         = $row['tipe'] ?? 'pilihan_ganda';
        $pilihanA     = $row['pilihan_a'] ?? $row['pilihana'] ?? '-';
        $pilihanB     = $row['pilihan_b'] ?? $row['pilihanb'] ?? '-';
        $pilihanC     = $row['pilihan_c'] ?? $row['pilihanc'] ?? '-';
        $pilihanD     = $row['pilihan_d'] ?? $row['pilihand'] ?? '-';
        $kunciJawaban = $row['kunci_jawaban'] ?? $row['kuncijawaban'] ?? '';

        // Jika baris data utama terdeteksi kosong, lewatkan saja
        if (empty($modulId) || empty($pertanyaan)) {
            return null;
        }

        // --- 3. MASUKKAN KE MODEL DATABASE ---
        return new Soal([
            'modul_id'      => $modulId,
            'pertanyaan'    => $pertanyaan,
            'kategori'      => strtolower($kategori),
            'fase'          => strtolower($fase),
            'tipe'          => strtolower($tipe), 
            'pilihan_a'     => $pilihanA,
            'pilihan_b'     => $pilihanB,
            'pilihan_c'     => $pilihanC,
            'pilihan_d'     => $pilihanD,
            'kunci_jawaban' => $kunciJawaban, 
        ]);
    }
}