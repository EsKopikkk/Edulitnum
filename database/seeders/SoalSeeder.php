<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SoalSeeder extends Seeder
{
    public function run()
    {
        DB::table('soal')->insert([
            // --- NUMERASI (10 SOAL) ---
            ['pertanyaan' => 'Ibu membeli 5 kotak pensil. Jika setiap kotak berisi 8 pensil, berapa jumlah seluruh pensil Ibu?', 'pilihan_a' => '35 pensil', 'pilihan_b' => '40 pensil', 'pilihan_c' => '45 pensil', 'pilihan_d' => '50 pensil', 'kunci_jawaban' => 'b', 'kategori' => 'numerasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Hasil dari 125 + 75 - 50 adalah...', 'pilihan_a' => '100', 'pilihan_b' => '125', 'pilihan_c' => '150', 'pilihan_d' => '175', 'kunci_jawaban' => 'c', 'kategori' => 'numerasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Budi memiliki 24 kelereng dan ingin membaginya rata kepada 4 temannya. Berapa kelereng yang didapat setiap teman?', 'pilihan_a' => '4 kelereng', 'pilihan_b' => '5 kelereng', 'pilihan_c' => '6 kelereng', 'pilihan_d' => '7 kelereng', 'kunci_jawaban' => 'c', 'kategori' => 'numerasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Bilangan yang tepat untuk mengisi titik-titik berikut: 2, 4, 6, ..., 10 adalah...', 'pilihan_a' => '7', 'pilihan_b' => '8', 'pilihan_c' => '9', 'pilihan_d' => '12', 'kunci_jawaban' => 'b', 'kategori' => 'numerasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Sebuah persegi memiliki panjang sisi 5 cm. Berapa keliling persegi tersebut?', 'pilihan_a' => '15 cm', 'pilihan_b' => '20 cm', 'pilihan_c' => '25 cm', 'pilihan_d' => '30 cm', 'kunci_jawaban' => 'b', 'kategori' => 'numerasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Manakah yang lebih besar hasilnya dari 5 x 4?', 'pilihan_a' => '3 x 6', 'pilihan_b' => '2 x 9', 'pilihan_c' => '4 x 4', 'pilihan_d' => '3 x 7', 'kunci_jawaban' => 'd', 'kategori' => 'numerasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Jika sekarang jam 08.00 pagi, maka 2 jam yang lalu adalah jam...', 'pilihan_a' => '05.00', 'pilihan_b' => '06.00', 'pilihan_c' => '07.00', 'pilihan_d' => '10.00', 'kunci_jawaban' => 'b', 'kategori' => 'numerasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Angka 7 pada bilangan 472 menempati nilai tempat...', 'pilihan_a' => 'Satuan', 'pilihan_b' => 'Puluhan', 'pilihan_c' => 'Ratusan', 'pilihan_d' => 'Ribuan', 'kunci_jawaban' => 'b', 'kategori' => 'numerasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Ayah memotong semangka menjadi 8 bagian sama besar. Adik memakan 2 bagian. Berapa bagian yang tersisa?', 'pilihan_a' => '4 bagian', 'pilihan_b' => '5 bagian', 'pilihan_c' => '6 bagian', 'pilihan_d' => '7 bagian', 'kunci_jawaban' => 'c', 'kategori' => 'numerasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Hasil dari 100 x 0 adalah...', 'pilihan_a' => '0', 'pilihan_b' => '1', 'pilihan_c' => '10', 'pilihan_d' => '100', 'kunci_jawaban' => 'a', 'kategori' => 'numerasi', 'status_validasi' => 1, 'created_at' => now()],

            // --- LITERASI (10 SOAL) ---
            ['pertanyaan' => 'Apa lawan kata dari "Cepat"?', 'pilihan_a' => 'Lari', 'pilihan_b' => 'Lambat', 'pilihan_c' => 'Lama', 'pilihan_d' => 'Lekas', 'kunci_jawaban' => 'b', 'kategori' => 'literasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Tanda baca yang digunakan di akhir kalimat tanya adalah...', 'pilihan_a' => 'Titik (.)', 'pilihan_b' => 'Koma (,)', 'pilihan_c' => 'Tanda Seru (!)', 'pilihan_d' => 'Tanda Tanya (?)', 'kunci_jawaban' => 'd', 'kategori' => 'literasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Ani rajin menyiram bunga agar tidak layu. Mengapa Ani menyiram bunga?', 'pilihan_a' => 'Supaya tumbuh besar', 'pilihan_b' => 'Supaya tidak layu', 'pilihan_c' => 'Supaya berwarna merah', 'pilihan_d' => 'Supaya dipuji Ibu', 'kunci_jawaban' => 'b', 'kategori' => 'literasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Siapa tokoh utama dalam cerita "Kancil dan Buaya"?', 'pilihan_a' => 'Kancil', 'pilihan_b' => 'Gajah', 'pilihan_c' => 'Harimau', 'pilihan_d' => 'Singa', 'kunci_jawaban' => 'a', 'kategori' => 'literasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Persamaan kata (sinonim) dari "Gembira" adalah...', 'pilihan_a' => 'Sedih', 'pilihan_b' => 'Marah', 'pilihan_c' => 'Senang', 'pilihan_d' => 'Takut', 'kunci_jawaban' => 'c', 'kategori' => 'literasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Ibu sedang memasak di...', 'pilihan_a' => 'Kamar Mandi', 'pilihan_b' => 'Ruang Tamu', 'pilihan_c' => 'Dapur', 'pilihan_d' => 'Gudang', 'kunci_jawaban' => 'c', 'kategori' => 'literasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Kalimat mana yang menggunakan huruf kapital dengan benar?', 'pilihan_a' => 'aku pergi ke Jakarta.', 'pilihan_b' => 'Aku pergi ke jakarta.', 'pilihan_c' => 'Aku pergi ke Jakarta.', 'pilihan_d' => 'aku pergi ke jakarta.', 'kunci_jawaban' => 'c', 'kategori' => 'literasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Benda ini terbuat dari kertas, memiliki halaman, dan bisa dibaca. Benda apakah itu?', 'pilihan_a' => 'Meja', 'pilihan_b' => 'Buku', 'pilihan_c' => 'Pensil', 'pilihan_d' => 'Tas', 'kunci_jawaban' => 'b', 'kategori' => 'literasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => 'Apa pesan moral dari cerita "Kelinci dan Kura-kura"?', 'pilihan_a' => 'Jangan sombong', 'pilihan_b' => 'Harus berlari cepat', 'pilihan_c' => 'Boleh berbohong', 'pilihan_d' => 'Tidur itu penting', 'kunci_jawaban' => 'a', 'kategori' => 'literasi', 'status_validasi' => 1, 'created_at' => now()],
            ['pertanyaan' => '"Pemandangan di pegunungan itu sangat indah." Kata sifat dalam kalimat tersebut adalah...', 'pilihan_a' => 'Pemandangan', 'pilihan_b' => 'Pegunungan', 'pilihan_c' => 'Sangat', 'pilihan_d' => 'Indah', 'kunci_jawaban' => 'd', 'kategori' => 'literasi', 'status_validasi' => 1, 'created_at' => now()],
        ]);
    }
}
