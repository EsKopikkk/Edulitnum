<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Soal;
use Illuminate\Support\Facades\DB;

class GameSoalSeeder extends Seeder
{
    public function run(): void
    {
        // Bersihkan data soal lama agar tidak terjadi duplikasi saat seeding ulang
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Soal::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // ==========================================================================
        // [BANK DATA] 300 SOAL STRUKTUR LENGKAP (50 LIT & 50 NUM PER FASE)
        // ==========================================================================

        // --- DATA FASE A (Kelas 1-2) ---
        $numA = [
            ['p' => 'Ibu membeli 5 buah apel, lalu Ayah membelikan lagi 7 buah apel. Berapa jumlah apel Ibu sekarang?', 'a' => '10 buah', 'b' => '11 buah', 'c' => '12 buah', 'd' => '13 buah', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Ali mempunyai 15 kelereng. Ia memberikan 6 kelereng kepada adiknya. Sisa kelereng Ali adalah...', 'a' => '8 kelereng', 'b' => '9 kelereng', 'c' => '10 kelereng', 'd' => '11 kelereng', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah hasil dari penjumlahan 24 + 13?', 'a' => '35', 'b' => '37', 'c' => '38', 'd' => '39', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah hasil dari pengurangan 48 - 15?', 'a' => '33', 'b' => '35', 'c' => '32', 'd' => '23', 'k' => 'A', 'cat' => 'Bilangan'],
            ['p' => 'Di dalam sebuah kandang ada 3 ekor ayam. Berapa jumlah semua kaki ayam di dalam kandang tersebut?', 'a' => '4 kaki', 'b' => '6 kaki', 'c' => '8 kaki', 'd' => '12 kaki', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Boni membeli 4 bungkus biskuit. Setiap bungkus berisi 5 wafer. Banyaknya wafer seluruhnya adalah...', 'a' => '15 wafer', 'b' => '20 wafer', 'c' => '25 wafer', 'd' => '30 wafer', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Ibu membagikan 12 buah jeruk kepada 3 anaknya sama banyak. Setiap anak menerima... buah jeruk.', 'a' => '3', 'b' => '4', 'c' => '5', 'd' => '6', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah nilai tempat angka 7 pada bilangan 175?', 'a' => 'Satuan', 'b' => 'Puluhan', 'c' => 'Ratusan', 'd' => 'Ribuan', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Manakah bilangan di bawah ini yang nilainya paling besar?', 'a' => '142', 'b' => '214', 'c' => '241', 'd' => '124', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Bilangan loncat 2 setelah angka 10 adalah...', 'a' => '11', 'b' => '12', 'c' => '13', 'd' => '14', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 35 + 42 adalah...', 'a' => '75', 'b' => '77', 'c' => '78', 'd' => '87', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 89 - 34 adalah...', 'a' => '45', 'b' => '55', 'c' => '65', 'd' => '54', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Ada 4 sarang burung, setiap sarang berisi 2 telur. Banyaknya telur seluruhnya adalah...', 'a' => '6', 'b' => '8', 'c' => '10', 'd' => '12', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Kakak mempunyai 10 permen dan dibagikan kepada 2 adiknya sama banyak. Candy yang diterima tiap adik adalah...', 'a' => '4', 'b' => '5', 'c' => '6', 'd' => '7', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Urutan bilangan dari yang terkecil adalah...', 'a' => '12, 15, 14', 'b' => '12, 14, 15', 'c' => '15, 14, 12', 'd' => '14, 12, 15', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Angka 9 pada bilangan 92 menempati nilai tempat...', 'a' => 'Satuan', 'b' => 'Puluhan', 'c' => 'Ratusan', 'd' => 'Ribuan', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah lambang bilangan dari "dua puluh delapan"?', 'a' => '208', 'b' => '28', 'c' => '82', 'd' => '2008', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Nama bilangan dari angka 143 adalah...', 'a' => 'Satu empat tiga', 'b' => 'Seratus empat puluh tiga', 'c' => 'Seratus empat tiga', 'd' => 'Empat puluh tiga', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Manakah bentuk bangun datar yang memiliki 3 sudut?', 'a' => 'Persegi', 'b' => 'Lingkaran', 'c' => 'Segitiga', 'd' => 'Persegi panjang', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Roda sepeda berbentuk bangun datar...', 'a' => 'Segitiga', 'b' => 'Persegi', 'c' => 'Lingkaran', 'd' => 'Kotak', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Buku tulis umumnya berbentuk bangun datar...', 'a' => 'Lingkaran', 'b' => 'Segitiga', 'c' => 'Persegi panjang', 'd' => 'Layang-layang', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Jumlah sisi pada bangun datar kotak persegi adalah...', 'a' => '3 sisi', 'b' => '4 sisi', 'c' => '5 sisi', 'd' => '6 sisi', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Sebelum hari Rabu adalah hari...', 'a' => 'Senin', 'b' => 'Selasa', 'c' => 'Kamis', 'd' => 'Jumat', 'k' => 'B', 'cat' => 'Pengukuran'],
            ['p' => 'Setelah hari Kamis adalah hari...', 'a' => 'Selasa', 'b' => 'Rabu', 'c' => 'Jumat', 'd' => 'Sabtu', 'k' => 'C', 'cat' => 'Pengukuran'],
            ['p' => 'Dalam satu minggu ada berapa hari?', 'a' => '5 hari', 'b' => '6 hari', 'c' => '7 hari', 'd' => '8 hari', 'k' => 'C', 'cat' => 'Pengukuran'],
            ['p' => 'Jarum pendek jam menunjuk angka 8, jarum panjang ke 12. Dibaca jam...', 'a' => 'Delapan', 'b' => 'Dua belas', 'c' => 'Sembilan', 'd' => 'Tujuh', 'k' => 'A', 'cat' => 'Pengukuran'],
            ['p' => 'Alat untuk mengukur berat suatu benda adalah...', 'a' => 'Penggaris', 'b' => 'Timbangan', 'c' => 'Meteran', 'd' => 'Jam dinding', 'k' => 'B', 'cat' => 'Pengukuran'],
            ['p' => 'Panjang pensil lebih tepat diukur menggunakan alat...', 'a' => 'Timbangan', 'b' => 'Penggaris', 'c' => 'Meteran gulung', 'd' => 'Jam', 'k' => 'B', 'cat' => 'Pengukuran'],
            ['p' => 'Manakah yang lebih berat, 1 buah semangka atau 1 buah jeruk?', 'a' => 'Jeruk', 'b' => 'Semangka', 'c' => 'Sama berat', 'd' => 'Tidak tahu', 'k' => 'B', 'cat' => 'Pengukuran'],
            ['p' => 'Manakah yang lebih ringan, selembar kertas atau sebuah kamus tebal?', 'a' => 'Kamus', 'b' => 'Selembar kertas', 'c' => 'Sama ringan', 'd' => 'Semua berat', 'k' => 'B', 'cat' => 'Pengukuran'],
            ['p' => 'Bilangan di antara 45 dan 47 adalah...', 'a' => '44', 'b' => '46', 'c' => '48', 'd' => '49', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 50 - 20 adalah...', 'a' => '20', 'b' => '30', 'c' => '40', 'd' => '10', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 15 + 15 adalah...', 'a' => '20', 'b' => '25', 'c' => '30', 'd' => '35', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Ada 2 baris kursi. Tiap baris berisi 6 kursi. Berapa jumlah semua kursi?', 'a' => '10', 'b' => '12', 'c' => '14', 'd' => '16', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Tiga puluh lima jika ditulis angka menjadi...', 'a' => '305', 'b' => '53', 'c' => '35', 'd' => '350', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Bilangan loncat 5 setelah angka 5 adalah...', 'a' => '6', 'b' => '10', 'c' => '15', 'd' => '20', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Bilangan sebelum angka 20 adalah...', 'a' => '18', 'b' => '19', 'c' => '21', 'd' => '22', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 8 + 9 adalah...', 'a' => '16', 'b' => '17', 'c' => '18', 'd' => '19', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 18 - 9 adalah...', 'a' => '7', 'b' => '8', 'c' => '9', 'd' => '10', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Bangun datar yang tidak memiliki sudut lancip atau lurus sama sekali adalah...', 'a' => 'Segitiga', 'b' => 'Persegi', 'c' => 'Lingkaran', 'd' => 'Layang-layang', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Sisi penampang atas sebuah meja belajar berbentuk...', 'a' => 'Lingkaran', 'b' => 'Segitiga', 'c' => 'Persegi panjang', 'd' => 'Bintang', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Bulan pertama dalam kalender tahunan adalah bulan...', 'a' => 'Februari', 'b' => 'Maret', 'c' => 'Januari', 'd' => 'Desember', 'k' => 'C', 'cat' => 'Pengukuran'],
            ['p' => 'Bulan terakhir dalam kalender masehi tahunan adalah bulan...', 'a' => 'Januari', 'b' => 'Oktober', 'c' => 'November', 'd' => 'Desember', 'k' => 'D', 'cat' => 'Pengukuran'],
            ['p' => 'Jarum panjang jam menunjuk angka 6, jarum pendek di tengah 1 and 2. Berarti jam...', 'a' => 'Jam 1 tepat', 'b' => 'Jam setengah 2', 'c' => 'Jam 2 tepat', 'd' => 'Jam setengah 1', 'k' => 'B', 'cat' => 'Pengukuran'],
            ['p' => 'Hasil dari 11 + 9 adalah...', 'a' => '18', 'b' => '19', 'c' => '20', 'd' => '21', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 30 - 15 adalah...', 'a' => '10', 'b' => '12', 'c' => '15', 'd' => '20', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Landi punya 7 boneka. Dayu punya 5 boneka. Jumlah boneka mereka adalah...', 'a' => '11', 'b' => '12', 'c' => '13', 'd' => '14', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Bilangan setelah 99 adalah...', 'a' => '98', 'b' => '100', 'c' => '101', 'd' => '110', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah jumlah sudut pada bangun datar segitiga sama sisi?', 'a' => '2', 'b' => '3', 'c' => '4', 'd' => '5', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Atap rumah pada umumnya terlihat seperti bentuk geometri...', 'a' => 'Lingkaran', 'b' => 'Segitiga', 'c' => 'Persegi panjang', 'd' => 'Trapesium', 'k' => 'B', 'cat' => 'Geometri'],
        ];

        $litA = [
            ['p' => 'Kancil berhasil menyeberangi sungai dengan mengelabui hewan apa?', 'a' => 'Gajah', 'b' => 'Buaya', 'c' => 'Harimau', 'd' => 'Ular', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Siapakah nama tokoh anak laki-laki di dongeng yang hidungnya memanjang saat berbohong?', 'a' => 'Aladin', 'b' => 'Pinokio', 'c' => 'Malin Kundang', 'd' => 'Sinbad', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Dongeng Malin Kundang mengajarkan anak-anak agar tidak durhaka kepada...', 'a' => 'Teman', 'b' => 'Guru', 'c' => 'Orang tua / Ibu', 'd' => 'Tetangga', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Kelinci kalah berlomba lari melawan kura-kura karena Kelinci sempat...', 'a' => 'Makan buah', 'b' => 'Tidur siang / meremehkan', 'c' => 'Tersesat jalan', 'd' => 'Kakinya terluka', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Bawang Putih memiliki sifat yang baik, sedangkan Bawang Merah memiliki sifat yang...', 'a' => 'Ramah', 'b' => 'Sombong dan iri hati', 'c' => 'Suka menolong', 'd' => 'Penyabar', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Tempat meminjam dan membaca buku-buku cerita yang lengkap di sekolah dinamakan...', 'a' => 'Kantin', 'b' => 'Laboratorium', 'c' => 'Perpustakaan', 'd' => 'Kantor Guru', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Sebutkan latar tempat tinggal tokoh fiksi Putri Duyung Ariel di dongeng anak!', 'a' => 'Hutan belantara', 'b' => 'Kerajaan bawah laut', 'c' => 'Puncak gunung', 'd' => 'Awan langit', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Dalam cerita "Semut dan Belalang", semut giat bekerja mengumpulkan makanan untuk menghadapi musim...', 'a' => 'Kemarau', 'b' => 'Hujan / Dingin', 'c' => 'Panen', 'd' => 'Gugur', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Lawan kata atau antonim dari kata "Rajin" adalah...', 'a' => 'Pintar', 'b' => 'Malas', 'c' => 'Giat', 'd' => 'Sombong', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Lawan kata atau antonim dari kata "Besar" adalah...', 'a' => 'Tinggi', 'b' => 'Lebar', 'c' => 'Kecil', 'd' => 'Panjang', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Siti suka merawat bunga. Bunga Siti tumbuh subur. Mengapa bunga Siti subur?', 'a' => 'Karena sering dibuang', 'b' => 'Karena rajin disiram', 'c' => 'Karena disimpan di gudang', 'd' => 'Karena dibiarkan saja', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Huruf kapital yang tepat pada kalimat "saya tinggal di makassar" digunakan pada kata...', 'a' => 'saya dan tinggal', 'b' => 'saya dan makassar', 'c' => 'tinggal saja', 'd' => 'di saja', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Sebelum makan kita harus melakukan aktivitas...', 'a' => 'Mencuci kaki', 'b' => 'Mencuci tangan dan berdoa', 'c' => 'Menggosok gigi', 'd' => 'Langsung tidur', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Kendaraan umum yang berjalan di atas rel kereta api dinamakan...', 'a' => 'Mobil Bus', 'b' => 'Kereta Api', 'c' => 'Kapal laut', 'd' => 'Pesawat terbang', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Tanda baca yang dipasang di akhir sebuah kalimat tanya adalah tanda...', 'a' => 'Titik (.)', 'b' => 'Koma (,)', 'c' => 'Tanya (?)', 'd' => 'Seru (!)', 'k' => 'C', 'cat' => 'Bahasa'],
            ['p' => 'Tanda baca yang dipasang untuk menutup kalimat berita biasa adalah...', 'a' => 'Tanya (?)', 'b' => 'Seru (!)', 'c' => 'Titik (.)', 'd' => 'Koma (,)', 'k' => 'C', 'cat' => 'Bahasa'],
            ['p' => 'Melati adalah jenis tanaman yang terkenal karena keindahan dan keharuman...', 'a' => 'Buahnya', 'b' => 'Daunnya', 'c' => 'Bunganya', 'd' => 'Akarnya', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Lawan kata atau antonim dari kata "Bersih" adalah...', 'a' => 'Wangi', 'b' => 'Kotor', 'c' => 'Indah', 'd' => 'Rapi', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Lawan kata atau antonim dari kata "Siang" adalah...', 'a' => 'Sore', 'b' => 'Pagi', 'c' => 'Malam', 'd' => 'Gelap', 'k' => 'C', 'cat' => 'Bahasa'],
            ['p' => 'Suara harimau terdengar sangat...', 'a' => 'Merdu', 'b' => 'Lembut', 'c' => 'Mengaum keras', 'd' => 'Mencicit', 'k' => 'C', 'cat' => 'Umum'],
            ['p' => 'Hewan yang terkenal suka makan wortel dan melompat-lompat adalah...', 'a' => 'Kucing', 'b' => 'Kelinci', 'c' => 'Kambing', 'd' => 'Kuda', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Susun kata menjadi kalimat yang benar: "Membaca - Budi - Buku"', 'a' => 'Membaca Budi Buku', 'b' => 'Buku Budi Membaca', 'c' => 'Budi Membaca Buku', 'd' => 'Buku Membaca Budi', 'k' => 'C', 'cat' => 'Bahasa'],
            ['p' => 'Ibu sedang memasak makanan di...', 'a' => 'Kamar tidur', 'b' => 'Halaman depan', 'c' => 'Dapur', 'd' => 'Kamar mandi', 'k' => 'C', 'cat' => 'Umum'],
            ['p' => 'Ayah membaca koran di teras rumah. Siapa yang membaca koran?', 'a' => 'Ibu', 'b' => 'Ayah', 'c' => 'Adik', 'd' => 'Kakak', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Burung bisa terbang tinggi di angkasa karena menggunakan...', 'a' => 'Kakinya', 'b' => 'Paruhnya', 'c' => 'Sayapnya', 'd' => 'Ekornya', 'k' => 'C', 'cat' => 'Umum'],
            ['p' => 'Kita mendengarkan penjelasan bapak dan ibu guru di sekolah menggunakan indra...', 'a' => 'Mata', 'b' => 'Hidung', 'c' => 'Telinga', 'd' => 'Lidah', 'k' => 'C', 'cat' => 'Umum'],
            ['p' => 'Kita melihat pemandangan alam pegunungan yang indah menggunakan indra...', 'a' => 'Telinga', 'b' => 'Mata', 'c' => 'Kulit', 'd' => 'Hidung', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Lawan kata atau antonim dari kata "Sedih" adalah...', 'a' => 'Menangis', 'b' => 'Gembira / Senang', 'c' => 'Duka', 'd' => 'Sakit', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Anak yang suka berbohong akan... oleh teman-teman.', 'a' => 'Disukai', 'b' => 'Dijauhi / tidak dipercaya', 'c' => 'Ditemani', 'd' => 'Dipuji', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Persamaan kata atau sinonim dari kata "Baju" adalah...', 'a' => 'Topi', 'b' => 'Pakaian', 'c' => 'Celana', 'd' => 'Sepatu', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Supaya giginya bersih dan sehat, kita harus rajin...', 'a' => 'Cuci muka', 'b' => 'Mandis', 'c' => 'Menggosok gigi', 'd' => 'Sisiran', 'k' => 'C', 'cat' => 'Umum'],
            ['p' => 'Setiap upacara bendera hari Senin, kita menyanyikan lagu kebangsaan...', 'a' => 'Indonesia Raya', 'b' => 'Balonku', 'c' => 'Pelangi', 'd' => 'Garuda Pancasila', 'k' => 'A', 'cat' => 'Umum'],
            ['p' => 'Randi membuang sampah plastik ke dalam...', 'a' => 'Sungai', 'b' => 'Lantai sekolah', 'c' => 'Tempat sampah', 'd' => 'Saku celana', 'k' => 'C', 'cat' => 'Umum'],
            ['p' => 'Kelinci berjalan dengan cara...', 'a' => 'Terbang', 'b' => 'Melompat', 'c' => 'Berenang', 'd' => 'Melata', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Ular bergerak menyusuri tanah dengan cara...', 'a' => 'Melompat', 'b' => 'Melata', 'c' => 'Terbang', 'd' => 'Berjalan kaki', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Persamaan kata atau sinonim dari kata "Mentari" adalah...', 'a' => 'Bulan', 'b' => 'Bintang', 'c' => 'Matahari', 'd' => 'Awan', 'k' => 'C', 'cat' => 'Bahasa'],
            ['p' => 'Kata tanya yang digunakan untuk menanyakan lokasi tempat adalah...', 'a' => 'Siapa', 'b' => 'Mengapa', 'c' => 'Di mana', 'd' => 'Kapan', 'k' => 'C', 'cat' => 'Bahasa'],
            ['p' => 'Kata tanya yang digunakan untuk menanyakan nama seseorang adalah...', 'a' => 'Kapan', 'b' => 'Siapa', 'c' => 'Berapa', 'd' => 'Mengapa', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Kata tanya yang digunakan untuk menanyakan waktu kejadian adalah...', 'a' => 'Di mana', 'b' => 'Kapan', 'c' => 'Bagaimana', 'd' => 'Siapa', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Beni rajin belajar, sehingga ia menjadi anak yang...', 'a' => 'Malas', 'b' => 'Bodoh', 'c' => 'Pintar', 'd' => 'Nakal', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Sebelum tidur malam, kita sebaiknya membersihkan diri dan jangan lupa...', 'a' => 'Makan berat', 'b' => 'Berdoa', 'c' => 'Belanja online', 'd' => 'Berolahraga', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Hewan yang menghasilkan madu manis yang sehat adalah...', 'a' => 'Semut', 'b' => 'Lebah', 'c' => 'Lalat', 'd' => 'Nyamuk', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Hewan yang menghasilkan susu segar untuk kita konsumsi adalah...', 'a' => 'Ayam', 'b' => 'Kucing', 'c' => 'Sapi', 'd' => 'Burung', 'k' => 'C', 'cat' => 'Umum'],
            ['p' => 'Lawan kata atau antonim dari kata "Muda" adalah...', 'a' => 'Kecil', 'b' => 'Tua', 'c' => 'Lama', 'd' => 'Baru', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Lawan kata atau antonim dari kata "Baru" adalah...', 'a' => 'Muda', 'b' => 'Lama / Usang', 'c' => 'Bagus', 'd' => 'Rusak', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Masakan ibu rasanya sangat lezat. Sinonim dari kata "Lezat" adalah...', 'a' => 'Pahit', 'b' => 'Enak / Sedap', 'c' => 'Asin', 'd' => 'Hambar', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Jika kita berbuat salah kepada teman, kita harus segera...', 'a' => 'Memarahinya', 'b' => 'Meminta maaf', 'c' => 'Menangis', 'd' => 'Bersembunyi', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Jika diberi hadiah atau dibantu orang lain, ucapan kita adalah...', 'a' => 'Minta lagi', 'b' => 'Terima kasih', 'c' => 'Sama-sama', 'd' => 'Permisi', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Saat ingin melewati orang yang lebih tua, kita mengucapkan kata...', 'a' => 'Halo', 'b' => 'Permisi', 'c' => 'Maaf', 'd' => 'Silahkan', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Lambang negara Indonesia adalah burung...', 'a' => 'Merpati', 'b' => 'Elang', 'c' => 'Garuda', 'd' => 'Cendrawasih', 'k' => 'C', 'cat' => 'Umum'],
        ];

        // --- DATA FASE B (Kelas 3-4) ---
        // --- DATA FASE B (Kelas 3-4) ---
        $numB = [
            ['p' => 'Hasil dari 12 x 5 adalah...', 'a' => '50', 'b' => '55', 'c' => '60', 'd' => '65', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Sebuah semangka dipotong menjadi 4 bagian sama besar. Nilai satu potong semangka adalah...', 'a' => '1/2', 'b' => '1/3', 'c' => '1/4', 'd' => '1/5', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 72 dibagi 8 adalah...', 'a' => '7', 'b' => '8', 'c' => '9', 'd' => '10', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Bilangan 4.325 angka 3 menempati nilai tempat...', 'a' => 'Satuan', 'b' => 'Puluhan', 'c' => 'Ratusan', 'd' => 'Ribuan', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Keliling persegi dengan panjang sisi 5 cm adalah...', 'a' => '10 cm', 'b' => '15 cm', 'c' => '20 cm', 'd' => '25 cm', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Luas persegi panjang dengan panjang 6 cm and lebar 4 cm adalah...', 'a' => '10 cm²', 'b' => '20 cm²', 'c' => '24 cm²', 'd' => '28 cm²', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Sudut yang besarnya tepat 90 derajat disebut sudut...', 'a' => 'Lancip', 'b' => 'Tumpul', 'c' => 'Siku-siku', 'd' => 'Lurus', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => '2 kg sama dengan berapa gram?', 'a' => '20 gram', 'b' => '200 gram', 'c' => '2.000 gram', 'd' => '20.000 gram', 'k' => 'C', 'cat' => 'Pengukuran'],
            ['p' => '3 meter sama dengan berapa sentimeter (cm)?', 'a' => '30 cm', 'b' => '300 cm', 'c' => '3.000 cm', 'd' => '30.000 cm', 'k' => 'B', 'cat' => 'Pengukuran'],
            ['p' => '2 jam sama dengan berapa menit?', 'a' => '60 menit', 'b' => '90 menit', 'c' => '120 menit', 'd' => '180 menit', 'k' => 'C', 'cat' => 'Pengukuran'],
            ['p' => 'Berapakah nilai dari perkalian 15 x 4?', 'a' => '45', 'b' => '50', 'c' => '55', 'd' => '60', 'k' => 'D', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah hasil dari pembagian 100 : 4?', 'a' => '20', 'b' => '25', 'c' => '30', 'd' => '35', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Pecahan 2/4 nilainya sama besar dengan pecahan...', 'a' => '1/2', 'b' => '1/3', 'c' => '1/5', 'd' => '3/4', 'k' => 'A', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah pembulatan bilangan 87 ke puluhan terdekat?', 'a' => '80', 'b' => '85', 'c' => '90', 'd' => '100', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah pembulatan bilangan 123 ke ratusan terdekat?', 'a' => '100', 'b' => '120', 'c' => '130', 'd' => '200', 'k' => 'A', 'cat' => 'Bilangan'],
            ['p' => 'Tiga buah uang logam lima ratusan setara nilainya dengan...', 'a' => 'Rp 1.000', 'b' => 'Rp 1.200', 'c' => 'Rp 1.500', 'd' => 'Rp 2.000', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah jumlah simetri lipat yang dimiliki oleh sebuah bangun datar persegi?', 'a' => '2', 'b' => '3', 'c' => '4', 'd' => '5', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Berapakah jumlah simetri lipat pada sebuah bangun datar segitiga sama sisi?', 'a' => '1', 'b' => '2', 'c' => '3', 'd' => '4', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Sudut yang besarnya kurang dari 90 derajat dinamakan sudut...', 'a' => 'Siku-siku', 'b' => 'Lancip', 'c' => 'Tumpul', 'd' => 'Lurus', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Sudut yang besarnya antara 90 sampai 180 derajat dinamakan sudut...', 'a' => 'Lancip', 'b' => 'Siku-siku', 'c' => 'Tumpul', 'd' => 'Refleks', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Bangun datar yang memiliki dua pasang sisi sejajar sama panjang dan empat sudut siku-siku adalah...', 'a' => 'Segitiga', 'b' => 'Jajar genjang', 'c' => 'Persegi panjang', 'd' => 'Trapesium', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Keliling segitiga sama sisi dengan panjang sisi 8 cm adalah...', 'a' => '16 cm', 'b' => '24 cm', 'c' => '32 cm', 'd' => '40 cm', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Luas persegi dengan panjang sisi 7 cm adalah...', 'a' => '28 cm²', 'b' => '35 cm²', 'c' => '42 cm²', 'd' => '49 cm²', 'k' => 'D', 'cat' => 'Geometri'],
            ['p' => 'Setengah jam sama dengan berapa menit?', 'a' => '15 menit', 'b' => '20 menit', 'c' => '30 menit', 'd' => '45 menit', 'k' => 'C', 'cat' => 'Pengukuran'],
            ['p' => '1 kg + 500 gram sama dengan berapa gram total seluruhnya?', 'a' => '1.500 gram', 'b' => '2.500 gram', 'c' => '501 gram', 'd' => '600 gram', 'k' => 'A', 'cat' => 'Pengukuran'],
            ['p' => '2 km sama dengan berapa meter?', 'a' => '200 meter', 'b' => '2.000 meter', 'c' => '20.000 meter', 'd' => '200.000 meter', 'k' => 'B', 'cat' => 'Pengukuran'],
            ['p' => 'Ibu membeli 3 liter minyak goreng. Skala liter termasuk alat ukur volume...', 'a' => 'Berat', 'b' => 'Panjang', 'c' => 'Zat Cair / Kapasitas', 'd' => 'Waktu', 'k' => 'C', 'cat' => 'Pengukuran'],
            ['p' => 'Berapakah hasil dari penjumlahan bilangan 150 + 275?', 'a' => '415', 'b' => '425', 'c' => '435', 'd' => '450', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah hasil dari pengurangan bilangan 500 - 185?', 'a' => '315', 'b' => '325', 'c' => '385', 'd' => '415', 'k' => 'A', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari perkalian 25 x 3 adalah...', 'a' => '65', 'b' => '70', 'c' => '75', 'd' => '85', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari pembagian 81 : 9 adalah...', 'a' => '7', 'b' => '8', 'c' => '9', 'd' => '10', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Manakah pecahan di bawah ini yang nilainya paling kecil?', 'a' => '3/4', 'b' => '2/4', 'c' => '1/4', 'd' => '4/4', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah hasil dari perkalian angka 9 x 6?', 'a' => '52', 'b' => '54', 'c' => '56', 'd' => '58', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah hasil dari pembagian angka 56 : 7?', 'a' => '6', 'b' => '7', 'c' => '8', 'd' => '9', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Angka 5 pada bilangan 2.587 menempati nilai tempat...', 'a' => 'Ribuan', 'b' => 'Ratusan', 'c' => 'Puluhan', 'd' => 'Satuan', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Lambang bilangan dari "dua ribu empat ratus lima" adalah...', 'a' => '2.405', 'b' => '2.450', 'c' => '2.405', 'd' => '2.045', 'k' => 'A', 'cat' => 'Bilangan'],
            ['p' => 'Urutan bilangan dari yang terbesar adalah...', 'a' => '341, 314, 413', 'b' => '413, 341, 314', 'c' => '314, 341, 413', 'd' => '413, 314, 341', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Sebuah segitiga memiliki alas berbentuk garis datar. Jumlah seluruh sudut dalam segitiga adalah... derajat.', 'a' => '90', 'b' => '120', 'c' => '180', 'd' => '360', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Bentuk papan tulis kelas pada umumnya adalah...', 'a' => 'Persegi', 'b' => 'Persegi panjang', 'c' => 'Belah ketupat', 'd' => 'Lingkaran', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => '150 menit sama dengan berapa jam?', 'a' => '2 jam', 'b' => '2.5 jam (2 jam 30 menit)', 'c' => '3 jam', 'd' => '3.5 jam', 'k' => 'B', 'cat' => 'Pengukuran'],
            ['p' => 'Hasil dari 450 + 320 adalah...', 'a' => '750', 'b' => '770', 'c' => '780', 'd' => '790', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 980 - 450 adalah...', 'a' => '510', 'b' => '530', 'c' => '540', 'd' => '550', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah keliling jajar genjang jika panjang sisi sejajarnya masing-masing adalah 10 cm dan 6 cm?', 'a' => '16 cm', 'b' => '32 cm', 'c' => '40 cm', 'd' => '60 cm', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Berapakah luas persegi panjang dengan ukuran panjang 10 cm dan lebar 5 cm?', 'a' => '15 cm²', 'b' => '30 cm²', 'c' => '50 cm²', 'd' => '60 cm²', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => '5 meter + 20 sentimeter sama dengan berapa sentimeter totalnya?', 'a' => '52 cm', 'b' => '205 cm', 'c' => '520 cm', 'd' => '5.200 cm', 'k' => 'C', 'cat' => 'Pengukuran'],
            ['p' => 'Bilangan loncat 10 dari 100 secara berurutan adalah...', 'a' => '110, 120, 130', 'b' => '105, 110, 115', 'c' => '120, 140, 160', 'd' => '110, 115, 120', 'k' => 'A', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 14 x 3 adalah...', 'a' => '32', 'b' => '42', 'c' => '52', 'd' => '62', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 96 : 3 adalah...', 'a' => '31', 'b' => '32', 'c' => '33', 'd' => '34', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Manakah di bawah ini yang merupakan contoh sudut tumpul?', 'a' => '45 derajat', 'b' => '90 derajat', 'c' => '110 derajat', 'd' => '60 derajat', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Uang senilai Rp 5.000 dapat ditukar dengan berapa lembar uang kertas Rp 1.000?', 'a' => '2 lembar', 'b' => '3 lembar', 'c' => '4 lembar', 'd' => '5 lembar', 'k' => 'D', 'cat' => 'Bilangan'],
        ];

        $litB = [
            ['p' => 'Gagasan utama atau inti masalah dalam sebuah paragraf disebut...', 'a' => 'Kalimat penjelas', 'b' => 'Ide pokok', 'c' => 'Kesimpulan', 'd' => 'Latar cerita', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Cerita rakyat Sangkuriang berasal dari provinsi...', 'a' => 'Jawa Tengah', 'b' => 'Jawa Barat', 'c' => 'Sumatera Utara', 'd' => 'Kalimantan Timur', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Tokoh utama yang memiliki sifat jahat dalam sebuah cerita dinamakan tokoh...', 'a' => 'Protagonis', 'b' => 'Antagonis', 'c' => 'Tritagonis', 'd' => 'Figuran', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Imbuhan "me-" pada kata "me+sapu" yang benar berubah menjadi...', 'a' => 'Mesapu', 'b' => 'Menyapu', 'c' => 'Memasapu', 'd' => 'Mensapu', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Teks yang berisi langkah-langkah atau panduan melakukan sesuatu disebut teks...', 'a' => 'Narasi', 'b' => 'Prosedur', 'c' => 'Deskripsi', 'd' => 'Puisi', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Pilihlah struktur kosa kata yang baku dan sesuai dengan kaidah EYD bahasa Indonesia!', 'a' => 'Apotek', 'b' => 'Apotik', 'c' => 'Jadwal', 'd' => 'Jadual', 'k' => 'A', 'cat' => 'Bahasa'],
            ['p' => 'Tokoh utama yang memiliki watak baik hati dalam cerita fiksi dinamakan...', 'a' => 'Antagonis', 'b' => 'Protagonis', 'c' => 'Tritagonis', 'd' => 'Figuran', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Dongeng yang menceritakan tentang kehidupan para hewan yang bertingkah seperti manusia disebut...', 'a' => 'Mite', 'b' => 'Legenda', 'c' => 'Fabel', 'd' => 'Sage', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Cerita rakyat Malin Kundang menceritakan legenda asal-usul objek benda...', 'a' => 'Danau Toba', 'b' => 'Batu Menangis', 'c' => 'Gunung Tangkuban Perahu', 'd' => 'Candi Prambanan', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Waktu dan tempat terjadinya peristiwa di dalam sebuah cerita fiksi dinamakan...', 'a' => 'Alur', 'b' => 'Latar / Setting', 'c' => 'Tema', 'd' => 'Amanat', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Kalimat yang membutuhkan objek penderita di dalam strukturnya dinamakan kalimat...', 'a' => 'Intransitif', 'b' => 'Transitif', 'c' => 'Pasif', 'd' => 'Tanya', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Kata depan yang paling tepat untuk menunjukkan suatu arah lokasi tempat adalah...', 'a' => 'Di', 'b' => 'Ke', 'c' => 'Dari', 'd' => 'Pada', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Sinonim atau persamaan makna dari kata "Gembira" adalah...', 'a' => 'Duka', 'b' => 'Sedih', 'c' => 'Senang / Bahagia', 'd' => 'Kecewa', 'k' => 'C', 'cat' => 'Bahasa'],
            ['p' => 'Antonim atau lawan makna dari kata "Pemberani" adalah...', 'a' => 'Takut / Penakut', 'b' => 'Giat', 'c' => 'Pintar', 'd' => 'Kuat', 'k' => 'A', 'cat' => 'Bahasa'],
            ['p' => 'Karya sastra yang terikat oleh bait dan rima yang indah dinamakan...', 'a' => 'Cerpen', 'b' => 'Novel', 'c' => 'Puisi', 'd' => 'Drama', 'k' => 'C', 'cat' => 'Umum'],
            ['p' => 'Teks yang berisi gambaran detail mengenai bentuk objek fisik disebut teks...', 'a' => 'Prosedur', 'b' => 'Narasi', 'c' => 'Deskripsi', 'd' => 'Eksplanasi', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Kalimat yang berisi perintah atau ajakan untuk melakukan sesuatu diakhiri tanda baca...', 'a' => 'Titik (.)', 'b' => 'Koma (,)', 'c' => 'Seru (!)', 'd' => 'Tanya (?)', 'k' => 'C', 'cat' => 'Bahasa'],
            ['p' => 'Majas atau gaya bahasa yang membandingkan dua hal secara langsung tanpa konjungsi disebut...', 'a' => 'Personifikasi', 'b' => 'Metafora', 'c' => 'Hiperbola', 'd' => 'Asosiasi', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Gagasan penjelas dalam paragraf berfungsi untuk...', 'a' => 'Menjadi inti cerita', 'b' => 'Mendukung atau menjelaskan gagasan pokok', 'c' => 'Menyimpulkan wacana', 'd' => 'Mengalihkan topik', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Penggunaan kamus besar bahasa Indonesia bertujuan untuk mencari makna dari kata...', 'a' => 'Gaul', 'b' => 'Baku / Standar', 'c' => 'Asing', 'd' => 'Singkatan', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Wawancara dilakukan untuk mengumpulkan data dari narasumber. Pengumpul data disebut...', 'a' => 'Narasumber', 'b' => 'Pewawancara', 'c' => 'Reporter', 'd' => 'Saksi', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Orang yang memberikan informasi atau jawaban saat diwawancarai dinamakan...', 'a' => 'Pewawancara', 'b' => 'Narasumber', 'c' => 'Moderator', 'd' => 'Direktur', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Laporan tertulis hasil pengamatan lapangan harus ditulis berdasarkan fakta, artinya...', 'a' => 'Sesuai khayalan penulis', 'b' => 'Sesuai kejadian nyata', 'c' => 'Berdasarkan cerita teman', 'd' => 'Rekayasa digital', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Kata "Kreatif" memiliki arti...', 'a' => 'Suka bermalas-malasan', 'b' => 'Banyak ide baru untuk menciptakan sesuatu', 'c' => 'Selalu menyontek tugas', 'd' => 'Sering mengeluh', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Berikut yang termasuk media cetak pembawa warta berita harian adalah...', 'a' => 'Televisi', 'b' => 'Radio', 'c' => 'Koran / Surat Kabar', 'd' => 'YouTube', 'k' => 'C', 'cat' => 'Umum'],
            ['p' => 'Ringkasan buku karangan non-fiksi yang dipasang di bagian belakang buku disebut...', 'a' => 'Daftar Pustaka', 'b' => 'Glosarium', 'c' => 'Sinopsis', 'd' => 'Kata Pengantar', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Lawan kata atau antonim dari kata "Cair" adalah...', 'a' => 'Gas', 'b' => 'Padat', 'c' => 'Beku', 'd' => 'Menguap', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Persamaan kata atau sinonim dari kata "Flora" adalah...', 'a' => 'Hewan', 'b' => 'Tumbuhan', 'c' => 'Manusia', 'd' => 'Bumi', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Persamaan kata atau sinonim dari kata "Fauna" adalah...', 'a' => 'Tumbuhan', 'b' => 'Hewan', 'c' => 'Alam', 'd' => 'Laut', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Tujuan utama membaca teks petunjuk penggunaan obat adalah...', 'a' => 'Mengetahui harga jual obat', 'b' => 'Memahami aturan pakai dan dosis secara aman', 'c' => 'Melihat pabrik pembuatnya', 'd' => 'Menghafal nama kimianya', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Kalimat yang berisi tanggapan penolakan secara santun ditandai oleh kata...', 'a' => 'Saya tidak mau', 'b' => 'Maaf, saya kurang sependapat', 'c' => 'Jangan begitu', 'd' => 'Kamu salah', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Cerita rakyat fiksi tentang sejarah kerajaan zaman dahulu yang bercampur mitos disebut...', 'a' => 'Fabel', 'b' => 'Sage', 'c' => 'Novel', 'd' => 'Puisi', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Bagian awal penutup dari surat pribadi berisi ucapan...', 'a' => 'Salam pembuka', 'b' => 'Harapan atau salam penutup', 'c' => 'Inti masalah', 'd' => 'Alamat tujuan', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Kata tanya "Mengapa" digunakan untuk menanyakan...', 'a' => 'Nama orang', 'b' => 'Alasan atau sebab peristiwa', 'c' => 'Cara melakukan sesuatu', 'd' => 'Waktu kejadian', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Kata tanya "Bagaimana" digunakan untuk menanyakan...', 'a' => 'Lokasi tujuan', 'b' => 'Cara, proses, atau keadaan', 'c' => 'Jumlah barang', 'd' => 'Pelaku utama', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Singkatan resmi dari "Majelis Permusyawaratan Rakyat" adalah...', 'a' => 'DPR', 'b' => 'MPR', 'c' => 'MA', 'd' => 'MK', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Unsur intrinsik cerita yang berisi pesan moral dari penulis disebut...', 'a' => 'Tema', 'b' => 'Alur', 'c' => 'Amanat', 'd' => 'Latar', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Rangkaian jalinan peristiwa urutan waktu di dalam cerita dinamakan...', 'a' => 'Latar', 'b' => 'Alur / Plot', 'c' => 'Tokoh', 'd' => 'Sudut pandang', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Manakah di bawah ini kata yang penulisan ejaannya tidak baku?', 'a' => 'Kualitas', 'b' => 'Kwalitas', 'c' => 'Izin', 'd' => 'Aktivitas', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Manakah pasangan kata antonim yang benar di bawah ini?', 'a' => 'Luas - Lebar', 'b' => 'Tinggi - Rendah', 'c' => 'Pintar - Cerdas', 'd' => 'Sama - Serupa', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Buku petunjuk resep masakan termasuk dalam kategori wacana teks...', 'a' => 'Deskripsi', 'b' => 'Prosedur', 'c' => 'Narasi', 'd' => 'Argumentasi', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Paragraf yang kalimat utamanya terletak di awal paragraf dinamakan...', 'a' => 'Induktif', 'b' => 'Deduktif', 'c' => 'Campuran', 'd' => 'Naratif', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Paragraf yang kalimat utamanya terletak di akhir paragraf dinamakan...', 'a' => 'Deduktif', 'b' => 'Induktif', 'c' => 'Campuran', 'd' => 'Deskriptif', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Kata dasar dari kata berimbuhan "Mendengar" adalah...', 'a' => 'Dengar', 'b' => 'Dengarkan', 'c' => 'Ngar', 'd' => 'Telinga', 'k' => 'A', 'cat' => 'Bahasa'],
            ['p' => 'Kata dasar dari kata berimbuhan "Menulis" adalah...', 'a' => 'Tulis', 'b' => 'Nulis', 'c' => 'Tulisan', 'd' => 'Pena', 'k' => 'A', 'cat' => 'Bahasa'],
            ['p' => 'Kamus Besar Bahasa Indonesia disingkat menjadi...', 'a' => 'KBI', 'b' => 'KBBI', 'c' => 'PUEBI', 'd' => 'EYD', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Kalimat efektif adalah kalimat yang disusun berdasarkan...', 'a' => 'Keinginan pribadi penulis saja', 'b' => 'Aturan kaidah tata bahasa', 'c' => 'Jumlah kata terbanyak', 'd' => 'Penggunaan majas', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Inti masalah atau pikiran utama dalam suatu paragraf disebut...', 'a' => 'Ide pokok', 'b' => 'Kalimat penjelas', 'c' => 'Judul buku', 'd' => 'Sub-bab', 'k' => 'A', 'cat' => 'Membaca'],
            ['p' => 'Lembaran informasi singkat berbentuk selebaran cetak promosi disebut...', 'a' => 'Buku', 'b' => 'Koran', 'c' => 'Brosur', 'd' => 'Kamus', 'k' => 'C', 'cat' => 'Umum'],
            ['p' => 'Orang yang menulis karya sastra berupa puisi dinamakan...', 'a' => 'Komponis', 'b' => 'Penyair / Pujangga', 'c' => 'Novelis', 'd' => 'Sutradara', 'k' => 'B', 'cat' => 'Umum'],
        ];

        // --- DATA FASE C (Kelas 5-6) ---
        $numC = [
            ['p' => 'Berapakah FPB dari bilangan 12 dan 18?', 'a' => '3', 'b' => '4', 'c' => '6', 'd' => '12', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah KPK dari bilangan 4 dan 6?', 'a' => '8', 'b' => '12', 'c' => '16', 'd' => '24', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari perkalian pecahan 1/2 x 3/4 adalah...', 'a' => '3/6', 'b' => '3/8', 'c' => '4/6', 'd' => '2/8', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Volume kubus yang memiliki panjang rusuk s = 4 cm adalah...', 'a' => '16 cm³', 'b' => '48 cm³', 'c' => '64 cm³', 'd' => '96 cm³', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Rata-rata (Mean) dari data nilai: 6, 7, 8, 9, 10 adalah...', 'a' => '7', 'b' => '8', 'c' => '8.5', 'd' => '9', 'k' => 'B', 'cat' => 'Pengukuran'],
            ['p' => 'Berapakah hasil dari 2 pangkat 3 (2³)?', 'a' => '4', 'b' => '6', 'c' => '8', 'd' => '16', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah nilai akar kuadrat dari bilangan 144?', 'a' => '10', 'b' => '11', 'c' => '12', 'd' => '14', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari penjumlahan pecahan 1/3 + 1/2 adalah...', 'a' => '2/5', 'b' => '5/6', 'c' => '3/5', 'd' => '1/6', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah nilai desimal dari pecahan biasa 3/5?', 'a' => '0.3', 'b' => '0.5', 'c' => '0.6', 'd' => '0.75', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Bentuk persen dari pecahan 1/4 adalah...', 'a' => '10%', 'b' => '20%', 'c' => '25%', 'd' => '50%', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah perbandingan nilai 15 banding 20 jika disederhanakan?', 'a' => '2 : 3', 'b' => '3 : 4', 'c' => '4 : 5', 'd' => '3 : 5', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Jika jarak pada peta 5 cm dan skala peta 1 : 100.000, berapakah jarak sebenarnya?', 'a' => '50 meter', 'b' => '500 meter', 'c' => '5 km', 'd' => '50 km', 'k' => 'C', 'cat' => 'Pengukuran'],
            ['p' => 'Sebuah balok memiliki ukuran panjang 5 cm, lebar 3 cm, dan tinggi 2 cm. Volume balok adalah...', 'a' => '10 cm³', 'b' => '15 cm³', 'c' => '30 cm³', 'd' => '45 cm³', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Berapakah jumlah rusuk yang dimiliki oleh sebuah bangun ruang kubus?', 'a' => '6', 'b' => '8', 'c' => '12', 'd' => '16', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Berapakah jumlah titik sudut pada bangun ruang limas segi empat?', 'a' => '4', 'b' => '5', 'c' => '6', 'd' => '8', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Luas lingkaran dengan jari-jari r = 7 cm adalah... (pi = 22/7)', 'a' => '44 cm²', 'b' => '154 cm²', 'c' => '308 cm²', 'd' => '616 cm²', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Nilai tengah dari sekumpulan data yang telah diurutkan dinamakan...', 'a' => 'Mean', 'b' => 'Median', 'c' => 'Modus', 'd' => 'Diagram', 'k' => 'B', 'cat' => 'Pengukuran'],
            ['p' => 'Data nilai yang paling sering muncul dalam suatu distribusi statistik dinamakan...', 'a' => 'Mean', 'b' => 'Median', 'c' => 'Modus', 'd' => 'Kuartil', 'k' => 'C', 'cat' => 'Pengukuran'],
            ['p' => 'Hasil perhitungan dari -12 + 8 adalah...', 'a' => '-20', 'b' => '-4', 'c' => '4', 'd' => '20', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil perhitungan matematika dari -5 x -6 adalah...', 'a' => '-30', 'b' => '11', 'c' => '30', 'd' => '-11', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah FPB dari bilangan 24 dan 36?', 'a' => '6', 'b' => '12', 'c' => '18', 'd' => '24', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah KPK dari bilangan 8 dan 12?', 'a' => '16', 'b' => '24', 'c' => '32', 'd' => '48', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari pembagian pecahan 2/3 : 4/5 adalah...', 'a' => '8/15', 'b' => '10/12', 'c' => '6/15', 'd' => '12/10', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah hasil dari 5 pangkat 3 (5³)?', 'a' => '15', 'b' => '75', 'c' => '125', 'd' => '225', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Nilai dari akar pangkat tiga dari bilangan 27 adalah...', 'a' => '3', 'b' => '4', 'c' => '9', 'd' => '24', 'k' => 'A', 'cat' => 'Bilangan'],
            ['p' => 'Desimal hasil dari urutan 1.5 - 0.25 adalah...', 'a' => '1.0', 'b' => '1.25', 'c' => '1.35', 'd' => '1.15', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Harga baju Rp 100.000 mendapat diskon 20%. Berapakah uang yang harus dibayarkan?', 'a' => 'Rp 20.000', 'b' => 'Rp 70.000', 'c' => 'Rp 80.000', 'd' => 'Rp 90.000', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Rumus untuk mencari luas bangun ruang lingkaran utuh adalah...', 'a' => '2 x pi x r', 'b' => 'pi x r x r', 'c' => 'pi x d', 'd' => '4 x pi x r', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Sebuah tabung memiliki jari-jari 7 cm dan tinggi 10 cm. Berapakah volume tabung?', 'a' => '154 cm³', 'b' => '1.540 cm³', 'c' => '3.080 cm³', 'd' => '700 cm³', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Jumlah sisi penampang permukaan pada sebuah bangun prisma segitiga adalah...', 'a' => '4 sisi', 'b' => '5 sisi', 'c' => '6 sisi', 'd' => '7 sisi', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Koordinat titik A terletak pada (3, -2). Angka -2 menunjukkan sumbu grafik...', 'a' => 'Sumbu X', 'b' => 'Sumbu Y', 'c' => 'Sumbu Z', 'd' => 'Titik pusat', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Data umur siswa: 11, 12, 11, 13, 12, 11, 11. Modus dari data tersebut adalah...', 'a' => '11', 'b' => '12', 'c' => '13', 'd' => '11.5', 'k' => 'A', 'cat' => 'Pengukuran'],
            ['p' => 'Kecepatan rata-rata mobil 60 km/jam. Jika waktu tempuh 2 jam, jaraknya adalah...', 'a' => '30 km', 'b' => '90 km', 'c' => '120 km', 'd' => '150 km', 'k' => 'C', 'cat' => 'Pengukuran'],
            ['p' => 'Volume air baku 120 liter mengalir selama 2 menit. Berapakah debit air per menit?', 'a' => '60 liter/menit', 'b' => '120 liter/menit', 'c' => '240 liter/menit', 'd' => '12 liter/menit', 'k' => 'A', 'cat' => 'Pengukuran'],
            ['p' => 'Hasil dari pembagian bilangan bulat negatif: -40 : 5 adalah...', 'a' => '8', 'b' => '-8', 'c' => '-7', 'd' => '7', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil perkalian matematika dari 1.2 x 0.3 adalah...', 'a' => '3.6', 'b' => '0.36', 'c' => '0.036', 'd' => '36.0', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah jumlah simetri putar yang dimiliki oleh bangun datar persegi?', 'a' => '2', 'b' => '3', 'c' => '4', 'd' => '5', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Bangun ruang yang memiliki satu titik puncak atas dan alas melingkar disebut...', 'a' => 'Tabung', 'b' => 'Kerucut', 'c' => 'Bola', 'd' => 'Prisma', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Sebuah segitiga siku-siku memiliki panjang alas 6 cm dan tinggi 8 cm. Sisi miringnya adalah...', 'a' => '9 cm', 'b' => '10 cm', 'c' => '12 cm', 'd' => '14 cm', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Berapakah 15% dari total nominal uang Rp 200.000?', 'a' => 'Rp 15.000', 'b' => 'Rp 20.000', 'c' => 'Rp 30.000', 'd' => 'Rp 40.000', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 125 x 8 adalah...', 'a' => '800', 'b' => '900', 'c' => '1.000', 'd' => '1.200', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari 1.000 : 25 adalah...', 'a' => '30', 'b' => '40', 'c' => '50', 'd' => '60', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Jika skala sebuah denah rumah 1 : 50, panjang 4 cm mewakili jarak asli...', 'a' => '2 meter', 'b' => '20 meter', 'c' => '200 meter', 'd' => '54 meter', 'k' => 'A', 'cat' => 'Pengukuran'],
            ['p' => 'Suhu udara di puncak gunung -3 derajat, lalu turun lagi 2 derajat. Suhu menjadi...', 'a' => '-1 derajat', 'b' => '-5 derajat', 'c' => '5 derajat', 'd' => '1 id', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Luas permukaan kubus yang memiliki panjang rusuk s = 3 cm adalah...', 'a' => '27 cm²', 'b' => '36 cm²', 'c' => '54 cm²', 'd' => '72 cm²', 'k' => 'C', 'cat' => 'Geometri'],
            ['p' => 'Berapakah jumlah titik sudut yang dimiliki oleh sebuah bangun ruang balok?', 'a' => '6', 'b' => '8', 'c' => '12', 'd' => '16', 'k' => 'B', 'cat' => 'Geometri'],
            ['p' => 'Pecahan biasa dari bentuk persen 75% adalah...', 'a' => '1/2', 'b' => '2/3', 'c' => '3/4', 'd' => '4/5', 'k' => 'C', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari penjumlahan 3.450 + 1.275 adalah...', 'a' => '4.625', 'b' => '4.725', 'c' => '4.825', 'd' => '4.925', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Hasil dari pengurangan matematika 7.500 - 2.850 adalah...', 'a' => '4.550', 'b' => '4.650', 'c' => '4.750', 'd' => '4.850', 'k' => 'B', 'cat' => 'Bilangan'],
            ['p' => 'Berapakah keliling bangun datar lingkaran yang berdiameter d = 14 cm?', 'a' => '22 cm', 'b' => '44 cm', 'c' => '88 cm', 'd' => '154 cm', 'k' => 'B', 'cat' => 'Geometri'],
        ];

        $litC = [
            ['p' => 'Teks yang berisi pendapat pribadi penulis disertai bukti fakta kuat dinamakan teks...', 'a' => 'Narasi', 'b' => 'Argumentasi', 'c' => 'Deskripsi', 'd' => 'Fabel', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Gaya bahasa atau majas perbandingan yang mengumpamakan benda mati bertingkah seperti manusia disebut...', 'a' => 'Majas Metafora', 'b' => 'Majas Personifikasi', 'c' => 'Majas Hiperbola', 'd' => 'Majas Litotes', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Manakah kalimat di bawah ini yang menggunakan kata baku secara tepat?', 'a' => 'Apotik itu tutup.', 'b' => 'Ibu membeli obat di Apotek resmi.', 'c' => 'Budi membuat jadual.', 'd' => 'Pikiran budi tidak fokus.', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Analisislah makna majas, ungkapan peribahasa, atau ide pokok wacana panjang!', 'a' => 'Denotasi', 'b' => 'Konotasi', 'c' => 'Metafora', 'd' => 'Kiasan', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Struktur pembuka teks pidato resmi kenegaraan yang baik berisi kalimat...', 'a' => 'Kesimpulan materi', 'b' => 'Ucapan puji syukur dan penghormatan', 'c' => 'Permintaan maaf penutup', 'd' => 'Sesi tanya jawab', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Teks yang memuat proses terjadinya suatu fenomena alam sosial ilmiah disebut teks...', 'a' => 'Narasi', 'b' => 'Eksplanasi', 'c' => 'Deskripsi', 'd' => 'Persuasi', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Kalimat yang bertujuan untuk merayu atau mengajak pembaca membeli sesuatu disebut teks...', 'a' => 'Deskripsi', 'b' => 'Persuasi / Iklan', 'c' => 'Argumentasi', 'd' => 'Narasi', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Ide pokok yang letaknya berada di awal dan diulang di akhir paragraf dinamakan paragraf...', 'a' => 'Deduktif', 'b' => 'Induktif', 'c' => 'Campuran', 'd' => 'Naratif', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Kata serapan asing "System" jika diubah ke dalam bentuk kata baku bahasa Indonesia menjadi...', 'a' => 'Sistem', 'b' => 'Sistim', 'c' => 'Sistemik', 'd' => 'Desain', 'k' => 'A', 'cat' => 'Bahasa'],
            ['p' => 'Kata serapan asing "Effective" jika diubah ke bentuk kata baku bahasa Indonesia yang benar adalah...', 'a' => 'Efektip', 'b' => 'Efektif', 'c' => 'Epekbip', 'd' => 'Efektipitas', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Ungkapan atau idiom "Meja Hijau" memiliki arti denotasi konotasi yaitu...', 'a' => 'Meja belajar kayu berwarna hijau', 'b' => 'Pengadilan jalur hukum resmi', 'c' => 'Tempat makan mewah', 'd' => 'Meja tenis olahraga', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Ungkapan idiom "Buah Bibir" memiliki makna kiasan yaitu...', 'a' => 'Membawa buah-buahan lipstik', 'b' => 'Menjadi bahan pembicaraan orang banyak', 'c' => 'Suka makan buah manis', 'd' => 'Anak emas kesayangan', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Ungkapan idiom "Rendah Hati" memiliki makna sifat yaitu...', 'a' => 'Sombong', 'b' => 'Tidak sombong / Baik hati', 'c' => 'Penakut', 'd' => 'Sakit jantung', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Gaya bahasa atau majas yang melebih-lebihkan sesuatu hal secara dramatis disebut...', 'a' => 'Litotes', 'b' => 'Hiperbola', 'c' => 'Metafora', 'd' => 'Personifikasi', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Majas yang mengecilkan fakta untuk merendahkan diri secara santun dinamakan majas...', 'a' => 'Hiperbola', 'b' => 'Litotes', 'c' => 'Ironi', 'd' => 'Sarkasme', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Berikut ini yang merupakan kalimat opini (pendapat subjektif) adalah...', 'a' => 'Indonesia adalah negara kepulauan.', 'b' => 'Pemandangan pantai itu sangat indah sekali.', 'c' => 'Ibu kota Indonesia saat ini adalah Jakarta.', 'd' => 'Garam dapur rasanya asin.', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Berikut ini yang merupakan kalimat fakta (objektif nyata) adalah...', 'a' => 'Belajar matematika itu sangat membosankan.', 'b' => 'Buku itu tebal dan rasanya kurang menarik.', 'c' => 'Air mendidih pada suhu 100 derajat Celsius.', 'd' => 'Rumah itu sangat megah dan bagus.', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Karya sastra fiksi yang menceritakan sepenggal kisah hidup tokoh secara singkat disebut...', 'a' => 'Novel', 'b' => 'Cerpen (Cerita Pendek)', 'c' => 'Biografi', 'd' => 'Ensiklopedia', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Buku rekam jejak riwayat hidup nyata seseorang yang ditulis oleh orang lain disebut buku...', 'a' => 'Autobiografi', 'b' => 'Biografi', 'c' => 'Novel fiksi', 'd' => 'Komik', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Buku riwayat hidup seseorang yang ditulis oleh dirinya sendiri dinamakan...', 'a' => 'Biografi', 'b' => 'Autobiografi', 'c' => 'Antologi', 'd' => 'Silabus', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Daftar buku atau referensi sumber pustaka rujukan penulisan karya ilmiah disebut...', 'a' => 'Kata Pengantar', 'b' => 'Daftar Pustaka', 'c' => 'Catatan Kaki', 'd' => 'Glosarium', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Kumpulan istilah penting beserta definisinya di bagian akhir buku dinamakan...', 'a' => 'Indeks', 'b' => 'Glosarium', 'c' => 'Daftar Isi', 'd' => 'Lampiran', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Kalimat langsung di dalam teks narasi fiksi ditandai oleh tanda baca...', 'a' => 'Kurung ( )', 'b' => 'Petik dua ("...")', 'c' => 'Titik dua (:)', 'd' => 'Garis miring (/)', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Kata penghubung atau konjungsi yang menyatakan hubungan akibat adalah...', 'a' => 'Karena', 'b' => 'Sehingga / Oleh karena itu', 'c' => 'Tetapi', 'd' => 'Dan', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Kata penghubung atau konjungsi yang menyatakan pertentangan kalimat adalah...', 'a' => 'Dan', 'b' => 'Namun / Tetapi', 'c' => 'Lalu', 'd' => 'Sebab', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Menatap layar gawai terlalu lama merusak mata. Apakah inti informasi teks tersebut?', 'a' => 'Gawai itu murah', 'b' => 'Bahaya radiasi gawai bagi kesehatan mata', 'c' => 'Mata sehat karena komputer', 'd' => 'Cara merakit gawai pintar', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Peribahasa "Tong kosong nyaring bunyinya" memiliki makna yaitu...', 'a' => 'Orang yang bodoh biasanya paling banyak bicara', 'b' => 'Tong besi yang tidak ada isinya kalau dipukul keras', 'c' => 'Orang pintar yang suka mengalah', 'd' => 'Membawa ember kosong', 'k' => 'A', 'cat' => 'Membaca'],
            ['p' => 'Peribahasa "Ada udang di balik batu" memiliki makna yaitu...', 'a' => 'Mencari udang di sungai', 'b' => 'Ada maksud atau motif tersembunyi', 'c' => 'Batu sungai yang besar', 'd' => 'Berbuat baik tanpa pamrih', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Teks ulasan yang berisi penilaian kelebihan dan kekurangan sebuah buku disebut...', 'a' => 'Resensi', 'b' => 'Sinopsis', 'c' => 'Artikel', 'd' => 'Tajuk Rencana', 'k' => 'A', 'cat' => 'Membaca'],
            ['p' => 'Artikel utama yang mencerminkan sikap resmi redaksi surat kabar terhadap suatu berita disebut...', 'a' => 'Iklan baris', 'b' => 'Tajuk Rencana / Editorial', 'c' => 'Opini pembaca', 'd' => 'Feuilleton', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Kalimat "Budi membelikan adiknya sebuah kamus." Kata "membelikan" merupakan kata kerja...', 'a' => 'Intransitif', 'b' => 'Transitif / Kausatif', 'c' => 'Pasif', 'd' => 'Majas', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Imbuhan "pe-an" pada kata "pendidikan" menyatakan bentuk makna...', 'a' => 'Proses melakukan sesuatu', 'b' => 'Tempat kejadian', 'c' => 'Alat perkakas', 'd' => 'Sifat orang', 'k' => 'A', 'cat' => 'Bahasa'],
            ['p' => 'Manakah kata di bawah ini yang tergolong dalam kata baku resmi?', 'a' => 'Jaman', 'b' => 'Zaman', 'c' => 'Fikir', 'd' => 'Nasehat', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Manakah kata di bawah ini yang ejaannya baku sesuai kamus resmi?', 'a' => 'Analisa', 'b' => 'Analisis', 'c' => 'Metodologi', 'd' => 'Praktek', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Kata baku dari "Praktek" yang benar adalah...', 'a' => 'Praktik', 'b' => 'Praktekan', 'c' => 'Pratikum', 'd' => 'Praktekum', 'k' => 'A', 'cat' => 'Bahasa'],
            ['p' => 'Kata baku dari "Nasehat" yang benar adalah...', 'a' => 'Nasihat', 'b' => 'Menasehati', 'c' => 'Penasehat', 'd' => 'Nasheat', 'k' => 'A', 'cat' => 'Bahasa'],
            ['p' => 'Teks yang menyajikan dua sudut pandang berbeda (pro dan kontra) disebut teks...', 'a' => 'Prosedur', 'b' => 'Diskusi', 'c' => 'Narasi', 'd' => 'Deskripsi', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Laporan yang berisi urutan kronologi waktu suatu perjalanan wisata disebut laporan...', 'a' => 'Laporan Hasil Observasi', 'b' => 'Laporan Perjalanan', 'c' => 'Laporan Keuangan', 'd' => 'Laporan Praktikum', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Singkatan resmi dari "Negara Kesatuan Republik Indonesia" adalah...', 'a' => 'RI', 'b' => 'NKRI', 'c' => 'UUD', 'd' => 'Pancasila', 'k' => 'B', 'cat' => 'Umum'],
            ['p' => 'Majas yang menyindir seseorang secara halus dengan mengatakan kebalikannya disebut...', 'a' => 'Majas Ironi', 'b' => 'Majas Hiperbola', 'c' => 'Majas Metafora', 'd' => 'Majas Personifikasi', 'k' => 'A', 'cat' => 'Membaca'],
            ['p' => 'Latar suasana yang tergambar dari kalimat "Air matanya berlinang mendengar berita duka itu" adalah...', 'a' => 'Gembira', 'b' => 'Tegang', 'c' => 'Sedih / Haru', 'd' => 'Menakutkan', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Teks narasi sejarah ditulis berdasarkan urutan kronologis, artinya...', 'a' => 'Berdasarkan urutan waktu terjadinya peristiwa', 'b' => 'Acak sesuai keinginan penulis', 'c' => 'Mencampur fiksi masa depan', 'd' => 'Hanya menampilkan dialog pendek', 'k' => 'A', 'cat' => 'Membaca'],
            ['p' => 'Sinonim dari kata "Kolaborasi" yang sering digunakan saat ini adalah...', 'a' => 'Persaingan', 'b' => 'Kerja sama', 'c' => 'Perpecahan', 'd' => 'Kemandirian', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Sinonim dari kata "Inovasi" adalah...', 'a' => 'Pembaruan / Penemuan Baru', 'b' => 'Kemunduran', 'c' => 'Kuno', 'd' => 'Tradisi lama', 'k' => 'A', 'cat' => 'Bahasa'],
            ['p' => 'Kata penunjuk waktu yang menyatakan masa lalu adalah...', 'a' => 'Besok', 'b' => 'Kemarin / Dahulu kala', 'c' => 'Sekarang', 'd' => 'Akan datang', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Kalimat yang memuat unsur Subjek, Predikat, Objek, dan Keterangan disebut kalimat...', 'a' => 'Tidak lengkap', 'b' => 'SPOK lengkap', 'c' => 'Kalimat tanya', 'd' => 'Kalimat perintah', 'k' => 'B', 'cat' => 'Bahasa'],
            ['p' => 'Jenis membaca dalam hati secara cepat untuk mencari informasi spesifik tertentu disebut teknik...', 'a' => 'Membaca intensif', 'b' => 'Membaca memindai', 'c' => 'Membaca nyaring', 'd' => 'Membaca puisi', 'k' => 'B', 'cat' => 'Membaca'],
            ['p' => 'Pikiran utama dari sebuah teks panjang dapat ditemukan paling cepat dengan membaca...', 'a' => 'Daftar pustaka', 'b' => 'Glosarium', 'c' => 'Judul dan Kalimat Utama tiap Paragraf', 'd' => 'Indeks buku', 'k' => 'C', 'cat' => 'Membaca'],
            ['p' => 'Orang yang memimpin jalannya diskusi kelompok besar resmi dinamakan...', 'a' => 'Narasumber', 'b' => 'Notulen', 'c' => 'Moderator', 'd' => 'Peserta', 'k' => 'C', 'cat' => 'Umum'],
            ['p' => 'Orang yang bertugas mencatat hasil jalannya rapat diskusi ilmiah dinamakan...', 'a' => 'Moderator', 'b' => 'Notulis / Notulen', 'c' => 'Ketua', 'd' => 'Saksi', 'k' => 'B', 'cat' => 'Umum'],
        ];

        // ==========================================================================
        // PROSES MASS INSERT OTOMATIS KE DALAM TABEL DENGAN BYPASS DB SAFETY
        // ==========================================================================

        // Matikan proteksi relasi asing sementara agar seeding berjalan super lancar
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Suntik data pancingan modul ber-ID 1 menggunakan skema kolom barumu ('judul')
        $namaTabelModul = 'moduls';
        $cekModul = DB::table($namaTabelModul)->where('id', 1)->exists();
        if (!$cekModul) {
            DB::table($namaTabelModul)->insert([
                'id'         => 1,
                'kelas_id'   => 1, // Penyeimbang relasi kelas_id terikat
                'judul'      => 'Modul Arena Utama Game Edulitnum',
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $fases = [
            'A' => ['numerasi' => $numA, 'literasi' => $litA],
            'B' => ['numerasi' => $numB, 'literasi' => $litB],
            'C' => ['numerasi' => $numC, 'literasi' => $litC]
        ];

        foreach ($fases as $fase => $types) {
            foreach ($types as $tipe => $soals) {
                foreach ($soals as $soal) {
                    Soal::create([
                        'modul_id'        => 1,
                        'pertanyaan'      => $soal['p'],
                        'kategori'        => $soal['cat'],
                        'tipe'            => $tipe,
                        'pilihan_a'       => $soal['a'],
                        'pilihan_b'       => $soal['b'],
                        'pilihan_c'       => $soal['c'],
                        'pilihan_d'       => $soal['d'],
                        'kunci_jawaban'   => $soal['k'],
                        'status_validasi' => 1, // Sesuai format integer MySQL lamamu
                        'fase'            => $fase
                    ]);
                }
            }
        }

        // Hidupkan kembali proteksi relasi database setelah semua data mendarat aman
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
