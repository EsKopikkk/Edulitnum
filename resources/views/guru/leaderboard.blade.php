<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papan Peringkat Siswa - EduLitNum</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 p-4 md:p-8 antialiased font-sans">
    <div class="max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-blue-700 to-blue-500 rounded-t-2xl p-8 text-white shadow-lg relative overflow-hidden">
            <!-- Hiasan Background -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-white opacity-10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/4"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                <div>
                    <h2 class="text-3xl font-extrabold tracking-tight">🏆 Papan Peringkat Siswa</h2>
                    <p class="text-blue-100 mt-2 text-lg">Pantau progres dan skor tertinggi siswa kelas Anda.</p>
                </div>
                <a href="/dashboard" class="px-5 py-2.5 bg-white/20 hover:bg-white/30 rounded-xl backdrop-blur-md font-semibold transition border border-white/30 shadow-sm flex items-center gap-2">
                    <span>⬅️</span> Kembali
                </a>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-b-2xl shadow-xl overflow-hidden border border-slate-200">
            <!-- Filter / Tab (Hanya Slicing UI) -->
            <div class="p-4 border-b border-slate-100 flex gap-2">
                <button class="px-4 py-2 bg-blue-50 text-blue-700 font-bold rounded-lg border border-blue-200 text-sm">Semua Fase</button>
                <button class="px-4 py-2 bg-white text-slate-600 font-medium rounded-lg border border-slate-200 hover:bg-slate-50 text-sm transition">Fase A</button>
                <button class="px-4 py-2 bg-white text-slate-600 font-medium rounded-lg border border-slate-200 hover:bg-slate-50 text-sm transition">Fase B</button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 uppercase text-xs font-extrabold tracking-wider border-b border-slate-200">
                            <th class="py-4 px-6 text-center w-24">Peringkat</th>
                            <th class="py-4 px-6">Nama Siswa</th>
                            <th class="py-4 px-6 text-center">Fase / Kelas</th>
                            <th class="py-4 px-6 text-center">Soal Selesai</th>
                            <th class="py-4 px-6 text-right">Total Skor</th>
                        </tr>
                    </thead>
                    <tbody class="text-slate-700 text-sm">
                        <!-- Data Dummy 1 (Juara 1) -->
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition group">
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-gradient-to-br from-yellow-300 to-yellow-500 text-white font-black rounded-full shadow-sm group-hover:scale-110 transition transform">1</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900 text-base">Fatimah Az Zahra</div>
                                <div class="text-xs text-slate-500">ID: SIS-001</div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-blue-100 text-blue-700 py-1 px-3 rounded-full font-semibold text-xs">Fase A - Kelas 1</span>
                            </td>
                            <td class="py-4 px-6 text-center font-medium">45/50</td>
                            <td class="py-4 px-6 text-right font-black text-blue-600 text-lg">9,850</td>
                        </tr>

                        <!-- Data Dummy 2 (Juara 2) -->
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition group">
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-gradient-to-br from-slate-300 to-slate-400 text-white font-black rounded-full shadow-sm group-hover:scale-110 transition transform">2</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900 text-base">Bima Arya</div>
                                <div class="text-xs text-slate-500">ID: SIS-042</div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-blue-100 text-blue-700 py-1 px-3 rounded-full font-semibold text-xs">Fase A - Kelas 2</span>
                            </td>
                            <td class="py-4 px-6 text-center font-medium">42/50</td>
                            <td class="py-4 px-6 text-right font-black text-blue-600 text-lg">8,920</td>
                        </tr>

                        <!-- Data Dummy 3 (Juara 3) -->
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition group">
                            <td class="py-4 px-6 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 bg-gradient-to-br from-amber-600 to-amber-700 text-white font-black rounded-full shadow-sm group-hover:scale-110 transition transform">3</span>
                            </td>
                            <td class="py-4 px-6">
                                <div class="font-bold text-slate-900 text-base">Cahaya Mentari</div>
                                <div class="text-xs text-slate-500">ID: SIS-018</div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-blue-100 text-blue-700 py-1 px-3 rounded-full font-semibold text-xs">Fase A - Kelas 1</span>
                            </td>
                            <td class="py-4 px-6 text-center font-medium">40/50</td>
                            <td class="py-4 px-6 text-right font-black text-blue-600 text-lg">8,500</td>
                        </tr>

                        <!-- Data Dummy 4 (Biasa) -->
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition">
                            <td class="py-4 px-6 text-center font-bold text-slate-400">4</td>
                            <td class="py-4 px-6">
                                <div class="font-semibold text-slate-800 text-base">Dicky Saputra</div>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <span class="bg-blue-100 text-blue-700 py-1 px-3 rounded-full font-semibold text-xs">Fase B - Kelas 3</span>
                            </td>
                            <td class="py-4 px-6 text-center font-medium">35/50</td>
                            <td class="py-4 px-6 text-right font-bold text-slate-600 text-lg">7,100</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination UI Dummy -->
            <div class="p-4 bg-slate-50 border-t border-slate-200 flex justify-between items-center text-sm text-slate-500">
                <span>Menampilkan 1 hingga 4 dari 40 siswa</span>
                <div class="flex gap-1">
                    <button class="px-3 py-1 bg-white border border-slate-200 rounded text-slate-400 cursor-not-allowed">Sebelumnya</button>
                    <button class="px-3 py-1 bg-blue-600 text-white rounded font-medium shadow-sm">1</button>
                    <button class="px-3 py-1 bg-white border border-slate-200 rounded hover:bg-slate-100">2</button>
                    <button class="px-3 py-1 bg-white border border-slate-200 rounded hover:bg-slate-100">Selanjutnya</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>