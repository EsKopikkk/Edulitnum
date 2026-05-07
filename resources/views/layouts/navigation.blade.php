<nav x-data="{ open: false }" class="border-b border-white/20" style="background-color: #E87F24;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg group-hover:rotate-6 transition-transform">
                            <span class="text-[#E87F24] font-black text-xl" style="font-family: 'Montserrat', sans-serif;">E</span>
                        </div>
                        <span class="text-white font-black text-xl tracking-tighter" style="font-family: 'Montserrat', sans-serif;">EDULITNUM</span>
                    </a>
                </div>

                <div class="hidden space-x-4 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="url('/')" :active="request()->is('/')" class="text-white border-white">
                        <span class="text-white font-bold">{{ __('Beranda') }}</span>
                    </x-nav-link>

                    @if(Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.akun.index')" :active="request()->routeIs('admin.akun.*')">
                            <span class="text-white font-bold opacity-80 hover:opacity-100">{{ __('Kelola Akun') }}</span>
                        </x-nav-link>
                        <x-nav-link :href="route('kelas.index')" :active="request()->routeIs('kelas.*')">
                            <span class="text-white font-bold opacity-80 hover:opacity-100">{{ __('Kelola Kelas') }}</span>
                        </x-nav-link>
                    @endif
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-4 py-2 border-2 border-white/20 text-sm font-black rounded-xl text-white bg-white/10 hover:bg-white/20 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">{{ __('Profile') }}</x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
            
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-white hover:bg-white/10 focus:outline-none transition duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</nav>