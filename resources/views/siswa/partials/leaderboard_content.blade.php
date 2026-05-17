@php
    // Solusi Sakti: Ambil data dulu baru diurutkan lewat Collection Laravel (Biar kebal Accessor)
    if (!isset($topPenyelam)) {
        $topPenyelam = \App\Models\User::where('role', 'siswa')
            ->get()
            ->sortByDesc('total_score_xp');
    }

    $currentUserId = Auth::id();
    $currentUserRank = null;

    // Cari peringkat user yang sedang login di dalam collection yang sudah disortir
    $rankCounter = 1;
    foreach($topPenyelam as $penyelam) {
        if($penyelam->id === $currentUserId) {
            $currentUserRank = $rankCounter;
            break;
        }
        $rankCounter++;
    }

    $limitTampil = ($currentUserRank == 4) ? 4 : 3;
    $tampilkan3Besar = $topPenyelam->take($limitTampil);
@endphp

<div class="space-y-2">
    {{-- Loop Peringkat Utama (1 Sampai 3/4 Besar) --}}
    @forelse($tampilkan3Besar as $penyelam)
        @php
            $isCurrentUser = ($penyelam->id === $currentUserId);
            $rank = $loop->iteration; // 👈 Menggunakan fitur bawaan Laravel, anti-typo dan kebal eror syntax!

            if ($rank == 1) {
                $bgStyle = 'bg-amber-100/80 border-amber-400 text-amber-950';
                $badge = '🥇';
            } elseif ($rank == 2) {
                $bgStyle = 'bg-slate-100/90 border-slate-300 text-slate-950';
                $badge = '🥈';
            } elseif ($rank == 3) {
                $bgStyle = 'bg-amber-600/10 border-amber-700/30 text-amber-900';
                $badge = '🥉';
            } else {
                $bgStyle = 'bg-white/60 border-white/40 text-blue-950';
                $badge = '🤿';
            }
        @endphp

        <div class="flex items-center justify-between border-2 p-3 rounded-2xl transition-all {{ $bgStyle }} {{ $isCurrentUser ? 'ring-2 ring-orange-500 shadow-md font-extrabold' : '' }}">
            <div class="flex items-center gap-2 truncate">
                <span class="text-xl select-none">{{ $badge }}</span>
                <span class="font-bold text-sm truncate">
                    {{ $isCurrentUser ? 'Kamu (' . $penyelam->name . ')' : $penyelam->name }}
                </span>
            </div>
            <span class="font-black text-sm shrink-0 pl-2">
                {{ $penyelam->total_score_xp ?? 0 }} XP
            </span>
        </div>
    @empty
        <div class="text-center py-6 text-xs text-blue-900/60 font-bold">
            Belum ada petualang yang menyelam 🌊
        </div>
    @endforelse

    {{-- Logika Titik-Titik jika user berada di peringkat 5 ke atas --}}
    @if($currentUserRank && $currentUserRank > 4)
        @php
            $userData = $topPenyelam->firstWhere('id', $currentUserId);
        @endphp

        <div class="text-center py-1 text-blue-950/60 font-black tracking-widest select-none">
            . . . . .
        </div>

        <div class="flex items-center justify-between border-2 p-3 rounded-2xl transition-all bg-blue-950/10 border-blue-950/20 text-blue-950 ring-2 ring-orange-500 shadow-md font-extrabold">
            <div class="flex items-center gap-2 truncate">
                <span class="text-sm font-black text-blue-900 bg-white/80 px-2 py-0.5 rounded-lg border border-blue-950/20 shadow-sm">
                    #{{ $currentUserRank }}
                </span>
                <span class="font-bold text-sm truncate">
                    Kamu ({{ $userData->name ?? 'Penyelam' }})
                </span>
            </div>
            <span class="font-black text-sm shrink-0 pl-2">
                {{ $userData->total_score_xp ?? 0 }} XP
            </span>
        </div>
    @endif
</div>