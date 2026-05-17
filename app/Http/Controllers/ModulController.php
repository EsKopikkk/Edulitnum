<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use App\Models\Kelas; // Memanggil data kelas
use Illuminate\Http\Request;

class ModulController extends Controller
{
    public function index()
    {
        // Ambil semua modul dan kelas untuk ditampilkan
        $moduls = Modul::latest()->get();
        $kelas = Kelas::all();

        return view('guru.modul', compact('moduls', 'kelas'));
    }

    /**
     * Menampilkan halaman modul untuk siswa
     */
    public function siswaShow($kategori = null)
    {
        $user = auth()->user();

        // Ambil kelas siswa
        $kelasSiswa = $user->siswaDetail()->first()?->kelas;

        if (!$kelasSiswa) {
            return view('siswa.modul.belum-kelas');
        }

        // Ambil modul dari kelas siswa
        $moduls = Modul::where('kelas_id', $kelasSiswa->id)->get();

        return view('siswa.modul.literasi', compact('moduls', 'kelasSiswa'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kelas_id' => 'required|exists:kelas,id',
            'deskripsi' => 'required|string',
            'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
        ]);

        $data = $request->only(['judul', 'kelas_id', 'deskripsi']);

        // Handle file upload
        if ($request->hasFile('file_materi')) {
            $file = $request->file('file_materi');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('materi', $filename, 'public');
            $data['file_materi'] = 'materi/' . $filename;
        }

        Modul::create($data);

        return redirect()->back()->with('success', 'Modul materi baru berhasil dibuat! 📚');
    }

    public function destroy($id)
    {
        Modul::destroy($id);
        return redirect()->back()->with('success', 'Modul materi berhasil dihapus! 🗑️');
    }

    public function show($id)
    {
        // Ambil data modul beserta kelasnya
        $modul = Modul::with('kelas')->findOrFail($id);

        return view('guru.show_modul', compact('modul'));
    }
}