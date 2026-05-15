<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\User;
use App\Models\Modul;
use App\Models\ModulProgress;
use Illuminate\Http\Request;

class KelasController extends Controller
{

public function index()
{
    $kelas = Kelas::with('guru')->withCount('siswa')->get();
    return view('admin.kelola_kelas', compact('kelas'));
}

public function manageModul($id)
{
    $kelas = Kelas::findOrFail($id);
    $moduls = Modul::where('kelas_id', $kelas->id)->get();
    $siswaDiKelas = $kelas->siswa()->with('user')->get();

    return view('admin.kelola_modul', compact('kelas', 'moduls', 'siswaDiKelas'));
}

    public function create()
    {
        $guru = User::where('role', 'guru')->get();
        return view('admin.tambah_kelas', compact('guru'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'fase' => 'required|in:A,B,C',
            'guru_id' => 'required|exists:users,id',
        ]);

        Kelas::create($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil ditambahkan!');
    }

    public function edit(Kelas $kelas)
    {
        $guru = User::where('role', 'guru')->get();
        return view('admin.edit_kelas', compact('kelas', 'guru'));
    }

    public function update(Request $request, Kelas $kelas)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'fase' => 'required|in:A,B,C',
            'guru_id' => 'required|exists:users,id',
        ]);

        $kelas->update($request->all());

        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil diupdate!');
    }

    public function show(Kelas $kelas)
{
    // Memuat data siswa yang ada di kelas tersebut melalui relasi siswa_detail [cite: 17-20, 82-85]
    $kelas->load(['guru', 'siswa.user']); 
    
    return view('admin.detail_kelas', compact('kelas'));
}
    public function destroy(Kelas $kelas)
    {
        $kelas->delete();
        return redirect()->route('kelas.index')->with('success', 'Kelas berhasil dihapus!');
    }

    // Tampilkan halaman kelola siswa dalam kelas
public function kelolaSiswa(Kelas $kelas)
{
    $siswaDiKelas = $kelas->siswa()->with('user')->get();
    $semuaSiswa = User::where('role', 'siswa')->get();
    return view('admin.kelola_siswa_kelas', compact('kelas', 'siswaDiKelas', 'semuaSiswa'));
}

// Tambah siswa ke kelas
public function tambahSiswa(Request $request, Kelas $kelas)
{
    $request->validate([
        'user_id' => 'required|exists:users,id',
    ]);

    // Cegah duplikat
    $sudahAda = \App\Models\SiswaDetail::where('user_id', $request->user_id)
                    ->where('kelas_id', $kelas->id)->exists();

    if ($sudahAda) {
        return back()->with('error', 'Siswa sudah ada di kelas ini!');
    }

    \App\Models\SiswaDetail::create([
        'user_id' => $request->user_id,
        'kelas_id' => $kelas->id,
    ]);

    return back()->with('success', 'Siswa berhasil ditambahkan ke kelas!');
}

// Hapus siswa dari kelas
public function hapusSiswa($kelas_id, $user_id)
{
    \App\Models\SiswaDetail::where('kelas_id', $kelas_id)
        ->where('user_id', $user_id)->delete();

    return back()->with('success', 'Siswa berhasil dikeluarkan dari kelas!');
}

// Tambah modul ke kelas
public function tambahModul(Request $request, Kelas $kelas)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'deskripsi' => 'nullable|string',
        'file_materi' => 'nullable|file|mimes:pdf,doc,docx,ppt,pptx,jpg,jpeg,png|max:10240',
    ]);

    $data = $request->only(['judul', 'deskripsi']);
    $data['kelas_id'] = $kelas->id;

    if ($request->hasFile('file_materi')) {
        $file = $request->file('file_materi');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('materi', $filename, 'public');
        $data['file_materi'] = 'materi/' . $filename;
    }

    Modul::create($data);

    // Inisialisasi progress untuk semua siswa di kelas
    $siswaDiKelas = $kelas->siswa()->pluck('user_id')->toArray();
    $modul = Modul::where('kelas_id', $kelas->id)->latest()->first();

    foreach ($siswaDiKelas as $user_id) {
        ModulProgress::firstOrCreate(
            ['user_id' => $user_id, 'modul_id' => $modul->id],
            ['status' => 'not_started']
        );
    }

    return back()->with('success', 'Modul berhasil ditambahkan!');
}

// Hapus modul dari kelas
public function hapusModul($kelas_id, $modul_id)
{
    $modul = Modul::where('id', $modul_id)->where('kelas_id', $kelas_id)->firstOrFail();
    ModulProgress::where('modul_id', $modul_id)->delete();
    $modul->delete();

    return back()->with('success', 'Modul berhasil dihapus!');
}

// Lihat progress siswa per modul
public function lihatProgressModul(Kelas $kelas, Modul $modul)
{
    $siswaDiKelas = $kelas->siswa()->with('user')->get();
    $progress = ModulProgress::where('modul_id', $modul->id)->get()->keyBy('user_id');

    return view('admin.progress_modul', compact('kelas', 'modul', 'siswaDiKelas', 'progress'));
}

}