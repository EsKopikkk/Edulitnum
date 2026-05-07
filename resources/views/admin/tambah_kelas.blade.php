<x-app-layout>
    {{-- Injeksi Font dan Style khusus agar menimpa default layout --}}
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@700;800;900&family=Poppins:wght@300;400;500;600&display=swap');

        /* Reset font untuk halaman ini */
        .edulitnum-area { font-family: 'Poppins', sans-serif; background-color: #FEFDDF; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }

        /* Animated background blobs (Sama dengan Welcome) */
        .blob {
            position: fixed;
            border-radius: 50%;
            filter: blur(90px);
            z-index: 0;
            animation: blobFloat 18s infinite alternate ease-in-out;
            pointer-events: none;
        }
        @keyframes blobFloat {
            0%   { transform: translate(0, 0) scale(1); }
            50%  { transform: translate(8%, 5%) scale(1.15); }
            100% { transform: translate(-5%, 10%) scale(1.25); }
        }

        /* Glassmorphism Card (Sama dengan Admin/Guru Panel) */
        .glass-card {
            background: rgba(255, 255, 255, 0.55);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            box-shadow: 
                0 30px 60px -12px rgba(26, 32, 44, 0.12),
                0 0 0 1px rgba(255, 255, 255, 0.4) inset;
        }

        /* Input styling (Halus & Modern) */
        .input-field {
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(115, 165, 202, 0.15);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-field:focus {
            border-color: #E87F24;
            background: #ffffff;
            outline: none;
            box-shadow: 0 0 0 4px rgba(232, 127, 36, 0.12);
        }

        /* Shimmer Logo Text */
        .shimmer-text {
            background: linear-gradient(90deg, #1A202C, #E87F24, #1A202C);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shine 4s linear infinite;
        }
        @keyframes shine { to { background-position: 200% center; } }

        /* Button Primary (Sama dengan Welcome/Get Started) */
        .btn-primary-edu {
            background: linear-gradient(135deg, #E87F24 0%, #C66A1B 100%);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 30px rgba(232, 127, 36, 0.35);
        }
        .btn-primary-edu:hover {
            transform: translateY(-3px);
            box-shadow: 0 20px 40px rgba(232, 127, 36, 0.45);
        }
        .btn-primary-edu:active { transform: translateY(0px) scale(0.98); }

        /* Dot Grid Decoration */
        .dot-grid {
            background-image: radial-gradient(circle, rgba(232, 127, 36, 0.15) 1px, transparent 1px);
            background-size: 24px 24px;
        }
    </style>

    <div class="edulitnum-area relative min-h-screen">
        {{-- Blobs --}}
        <div class="blob w-[500px] h-[500px] bg-[#FFC81E]/20 -top-20 -left-20"></div>
        <div class="blob w-[450px] h-[450px] bg-[#73A5CA]/15 -bottom-20 -right-20" style="animation-delay: -7s;"></div>
        
        <div class="relative z-10 py-12 px-4 sm:px-6 lg:px-8">
            <div class="max-w-2xl mx-auto">
                
                {{-- Breadcrumb/Back --}}
                <a href="{{ route('kelas.index') }}" class="flex items-center gap-2 text-edu-dark/50 font-bold text-xs uppercase tracking-widest hover:text-edu-orange transition-colors mb-8 group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Kembali ke Manajemen Kelas
                </a>

                {{-- Title Section --}}
                <div class="mb-10">
                    <h2 class="text-4xl font-black text-edu-dark font-montserrat tracking-tighter leading-none">
                        Tambah <span class="shimmer-text">Kelas Baru</span>
                    </h2>
                    <p class="text-gray-500 font-medium mt-3">Siapkan ruang petualangan baru untuk para siswa! 🚀</p>
                </div>

                {{-- Main Card --}}
                <div class="glass-card rounded-[3rem] p-8 md:p-12 relative overflow-hidden">
                    {{-- Dot Grid internal --}}
                    <div class="absolute top-0 right-0 w-32 h-32 dot-grid opacity-40 pointer-events-none"></div>

                    <form method="POST" action="{{ route('kelas.store') }}" class="space-y-8 relative z-10">
                        @csrf

                        {{-- Input Nama Kelas --}}
                        <div class="space-y-3">
                            <label class="block text-[11px] font-black uppercase tracking-[0.2em] text-edu-blue ml-2">
                                Nama Kelas
                            </label>
                            <input type="text" name="nama_kelas" 
                                   placeholder="Contoh: Kelas 4 - Numerasi Cerdas"
                                   class="input-field w-full px-6 py-4 rounded-2xl font-bold text-edu-dark placeholder:text-gray-300" 
                                   required autofocus>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- Input Fase --}}
                            <div class="space-y-3">
                                <label class="block text-[11px] font-black uppercase tracking-[0.2em] text-edu-blue ml-2">
                                    Fase
                                </label>
                                <div class="relative">
                                    <select name="fase" class="input-field w-full px-6 py-4 rounded-2xl font-bold text-edu-dark appearance-none cursor-pointer" required>
                                        <option value="A">Fase A (Kelas 1-2)</option>
                                        <option value="B">Fase B (Kelas 3-4)</option>
                                        <option value="C">Fase C (Kelas 5-6)</option>
                                    </select>
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-edu-orange">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                            </div>

                            {{-- Input Guru --}}
                            <div class="space-y-3">
                                <label class="block text-[11px] font-black uppercase tracking-[0.2em] text-edu-blue ml-2">
                                    Guru Pengampu
                                </label>
                                <div class="relative">
                                    <select name="guru_id" class="input-field w-full px-6 py-4 rounded-2xl font-bold text-edu-dark appearance-none cursor-pointer" required>
                                        @foreach($guru as $g)
                                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="absolute right-5 top-1/2 -translate-y-1/2 pointer-events-none text-edu-orange">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"/></svg>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="flex flex-col sm:flex-row gap-4 pt-6">
                            <button type="submit"
                                    class="btn-primary-edu flex-[2] py-5 rounded-[1.5rem] text-white font-black text-lg flex items-center justify-center gap-3">
                                <span>SIMPAN KELAS</span>
                                <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            </button>
                            
                            <a href="{{ route('kelas.index') }}"
                               class="flex-1 py-5 rounded-[1.5rem] font-bold text-edu-dark bg-white/50 border-2 border-transparent hover:border-gray-200 transition-all text-center flex items-center justify-center">
                                Batal
                            </a>
                        </div>
                    </form>
                </div>
                
                {{-- Footer Info --}}
                <p class="text-center mt-10 text-gray-400 text-[10px] font-bold tracking-[0.3em] uppercase opacity-50">
                    © 2026 EDULITNUM ECOSYSTEM • ADMIN SESSION
                </p>
            </div>
        </div>
    </div>
</x-app-layout>