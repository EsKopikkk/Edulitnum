@php
    // Solusi Sakti: Ambil data dulu baru diurutkan lewat Collection Laravel (Biar kebal Accessor)
    if (!isset($topPenyelam)) {
        $topPenyelam = \App\Models\User::where('role', 'siswa')
            ->get()
            ->sortByDesc('total_score_xp');
    }
@endphp

<table class="w-full text-left border-collapse min-w-max">
    <thead>
        <tr class="bg-gray-50 border-b-2 border-gray-100">
            <th class="p-4 text-[11px] font-black text-gray-400 uppercase text-center w-16">Rank</th>
            <th class="p-4 text-[11px] font-black text-gray-400 uppercase">Nama Penyelam</th>
            <th class="p-4 text-[11px] font-black text-gray-400 uppercase text-center">Total Skor</th>
            <th class="p-4 text-[11px] font-black text-gray-400 uppercase text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        @forelse($topPenyelam as $index => $penyelam)
        <tr class="border-b border-gray-50 hover:bg-orange-50/30 transition-colors">
            <td class="p-4 text-center font-black text-gray-500">#{{ $loop->iteration }}</td>
            <td class="p-4 text-sm font-bold text-gray-800 flex items-center gap-2">
                <span>🤿</span> {{ $penyelam->name }}
            </td>
            <td class="p-4 text-center">
                <span class="px-3 py-1 bg-amber-100 text-amber-700 font-black rounded-lg text-xs">
                    ⭐ {{ $penyelam->total_score_xp ?? 0 }} XP
                </span>
            </td>
            <td class="p-4 text-center">
                <span class="text-xs font-bold text-green-500 bg-green-50 px-3 py-1 rounded-full border border-green-100">
                    Aktif Menyelam
                </span>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="p-8 text-center text-gray-400 font-medium">Belum ada siswa yang terdata.</td>
        </tr>
        @endforelse
    </tbody>
</table>