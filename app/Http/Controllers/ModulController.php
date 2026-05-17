<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Kelas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // 👈 Wajib untuk hapus/simpan file di storage

class ModulController extends Controller
{
    // 1. HALAMAN UTAMA GURU (DAFTAR MODUL & DROPDOWN KELAS)
    public function index()
    {
        // Eager loading 'kelas' agar relasi kelas terbaca di view
        $moduls = Modul::with('kelas')->latest()->get();
        $kelas = Kelas::all(); // 👈 Menarik data kelas untuk dropdown form
        
        return view('guru.modul', compact('moduls', 'kelas'));
    }

    // 2. PROSES SIMPAN MODUL BARU (LENGKAP DENGAN UPLOAD FILE)
    public function store(Request $request)
    {
        $request->validate([
            'judul'         => 'required|string|max:255',
            'kelas_id'      => 'required',
            'jenis_modul'   => 'required|in:numerasi,literasi',
            'deskripsi'     => 'required|string',
            'isi_materi'    => 'required|string',
            'soal_numerik'  => 'nullable|string',
            'gambar'        => 'nullable|image|max:2048',
            'gambar_konten' => 'nullable|image|max:2048',
            'file_materi'   => 'nullable|file|max:10240',
        ]);

        $data = $request->all();

        // Upload Gambar Sampul Card
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('modul_sampul', 'public');
        }

        // Upload Gambar Ilustrasi Konten Dalam
        if ($request->hasFile('gambar_konten')) {
            $data['gambar_konten'] = $request->file('gambar_konten')->store('modul_konten', 'public');
        }

        // Upload File Materi Tambahan (PDF/PPT/Doc)
        if ($request->hasFile('file_materi')) {
            $data['file_materi'] = $request->file('file_materi')->store('modul_files', 'public');
        }

        Modul::create($data);

        return redirect()->back()->with('success', 'Modul materi baru berhasil dibuat! 📚🚀');
    }

    // 3. DETAIL ISI MODUL & MANAGEMENT SOAL KUIS (SISI GURU)
    public function show($id)
    {
        // Mengambil modul beserta data kelas dan soal-soal kuis yang berelasi
        $modul = Modul::with(['kelas', 'soals'])->findOrFail($id);
        
        return view('guru.show_modul', compact('modul'));
    }

    // 4. FITUR EDIT: MENAMPILKAN HALAMAN FORM EDIT MODUL
    public function edit($id)
{
    $modul = Modul::findOrFail($id);
    $kelas = Kelas::all(); // Mengambil data kelas untuk isi dropdown di form edit

    // FIX EROR: Ubah dari 'guru.modul_edit' menjadi 'guru.edit_modul'
    return view('guru.edit_modul', compact('modul', 'kelas'));
}

    // 5. FITUR EDIT: PROSES PEMBARUAN DATA DI DATABASE
    public function update(Request $request, $id)
    {
        $modul = Modul::findOrFail($id);

        $request->validate([
            'judul'         => 'required|string|max:255',
            'kelas_id'      => 'required',
            'jenis_modul'   => 'required|in:numerasi,literasi',
            'deskripsi'     => 'required|string',
            'isi_materi'    => 'required|string',
            'soal_numerik'  => 'nullable|string',
            'gambar'        => 'nullable|image|max:2048',
            'gambar_konten' => 'nullable|image|max:2048',
            'file_materi'   => 'nullable|file|max:10240',
        ]);

        $data = $request->all();

        // Ganti file Sampul Card jika ada yang baru
        if ($request->hasFile('gambar')) {
            if ($modul->gambar) Storage::disk('public')->delete($modul->gambar);
            $data['gambar'] = $request->file('gambar')->store('modul_sampul', 'public');
        }

        // Ganti Gambar Ilustrasi Dalam jika ada yang baru
        if ($request->hasFile('gambar_konten')) {
            if ($modul->gambar_konten) Storage::disk('public')->delete($modul->gambar_konten);
            $data['gambar_konten'] = $request->file('gambar_konten')->store('modul_konten', 'public');
        }

        // Ganti File Lampiran jika ada yang baru
        if ($request->hasFile('file_materi')) {
            if ($modul->file_materi) Storage::disk('public')->delete($modul->file_materi);
            $data['file_materi'] = $request->file('file_materi')->store('modul_files', 'public');
        }

        $modul->update($data);

        return redirect()->route('modul.index')->with('success', 'Modul berhasil diperbarui! 🚀✨');
    }

    // 6. PROSES HAPUS MODUL MATERI beserta File-filenya
    public function destroy($id)
    {
        $modul = Modul::findOrFail($id);

        // Hapus file fisik dari storage lokal agar penyimpanan laptop tetap bersih
        if ($modul->gambar) Storage::disk('public')->delete($modul->gambar);
        if ($modul->gambar_konten) Storage::disk('public')->delete($modul->gambar_konten);
        if ($modul->file_materi) Storage::disk('public')->delete($modul->file_materi);

        $modul->delete();

        return redirect()->back()->with('success', 'Modul materi berhasil dihapus! 🗑️');
    }

    // 7. MENAMPILKAN HALAMAN MODUL UNTUK SISWA (FILTER OTOMATIS)
    public function siswaShow($kategori = null)
    {
        $user = auth()->user();

        // Ambil kelas siswa
        $kelasSiswa = $user->siswaDetail()->first()?->kelas;

        if (!$kelasSiswa) {
            return view('siswa.modul.belum-kelas');
        }

        // Membaca modul berdasarkan kelas siswa & kategori (literasi/numerasi) yang diklik
        $query = Modul::where('kelas_id', $kelasSiswa->id);
        
        if ($kategori) {
            $query->where('jenis_modul', $kategori);
        }

        $moduls = $query->get();

        return view('siswa.modul.literasi', compact('moduls', 'kelasSiswa', 'kategori'));
    }
    
}