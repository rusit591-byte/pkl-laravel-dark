<nav x-data="{ open: false }" class="bg-darkSurface border-b border-darkBorder sticky top-0 z-40">
    <!-- Primary Navigation Menu -->
    <div class="max-w-5xl mx-auto px-6">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo / Brand Website -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-sm font-bold text-white tracking-wide flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-accentGreen"></span> PKL Laravel
                    </a>
                </div>

                <!-- Navigation Links (Menu Utama Website & Jurnal) -->
                <div class="hidden space-x-4 sm:-my-px sm:ms-8 sm:flex sm:items-center">
                    <a href="{{ route('home') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('home') ? 'bg-darkBorder text-accentGreen' : 'text-gray-300 hover:text-white hover:bg-darkBorder/50' }}">
                        Beranda
                    </a>
                    <a href="{{ route('about') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('about') ? 'bg-darkBorder text-accentGreen' : 'text-gray-300 hover:text-white hover:bg-darkBorder/50' }}">
                        Tentang
                    </a>
                    <a href="{{ route('contact') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('contact') ? 'bg-darkBorder text-accentGreen' : 'text-gray-300 hover:text-white hover:bg-darkBorder/50' }}">
                        Kontak
                    </a>

                    @auth
                        <a href="{{ route('jurnals.index') }}" class="px-3 py-2 rounded-lg text-sm font-medium transition {{ request()->routeIs('jurnals*') ? 'bg-darkBorder text-accentGreen' : 'text-gray-300 hover:text-white hover:bg-darkBorder/50' }}">
                            Jurnal Harian
                        </a>
                    @endauth
                </div>
            </div>

            <!-- Settings Dropdown / Tombol Auth (Kanan Atas) -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-darkBorder text-sm leading-4 font-medium rounded-md text-gray-300 bg-darkBase hover:text-white focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-darkSurface border border-darkBorder rounded-md overflow-hidden text-gray-200">
                                <x-dropdown-link :href="route('profile.edit')" class="hover:bg-darkBorder">
                                    {{ __('Profile') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('jurnals.index')" class="hover:bg-darkBorder">
                                    {{ __('Jurnal Harian') }}
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault(); this.closest('form').submit();" class="hover:bg-darkBorder text-red-400">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <!-- Tombol Login & Register jika belum masuk -->
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('login') }}" class="text-xs font-semibold text-gray-300 hover:text-white px-3 py-2 rounded bg-darkBase border border-darkBorder transition">Log in</a>
                        <a href="{{ route('register') }}" class="text-xs font-semibold text-slate-950 bg-accentGreen hover:bg-green-400 px-3 py-2 rounded transition">Register</a>
                    </div>
                @endauth
            </div>

            <!-- Hamburger (Menu Mobile) -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-300 hover:bg-darkBorder focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu (Tampilan HP / Mobile) -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-darkSurface border-b border-darkBorder px-4 pt-2 pb-4 space-y-2">
        <a href="{{ route('home') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-darkBorder">Beranda</a>
        <a href="{{ route('about') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-darkBorder">Tentang</a>
        <a href="{{ route('contact') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-gray-300 hover:bg-darkBorder">Kontak</a>

        @auth
            <a href="{{ route('jurnals.index') }}" class="block px-3 py-2 rounded-md text-sm font-medium text-accentGreen hover:bg-darkBorder">Jurnal Harian</a>
            
            <div class="pt-4 pb-1 border-t border-darkBorder">
                <div class="px-3 mb-2">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <a href="{{ route('profile.edit') }}" class="block px-3 py-2 rounded-md text-sm text-gray-300 hover:bg-darkBorder">Profile</a>
                
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-3 py-2 rounded-md text-sm text-red-400 hover:bg-darkBorder">Log Out</button>
                </form>
            </div>
        @else
            <div class="pt-3 border-t border-darkBorder flex gap-2">
                <a href="{{ route('login') }}" class="flex-1 text-center py-2 bg-darkBase border border-darkBorder text-gray-300 rounded text-sm">Log in</a>
                <a href="{{ route('register') }}" class="flex-1 text-center py-2 bg-accentGreen text-slate-950 font-bold rounded text-sm">Register</a>
            </div>
        @endauth
    </div>
</nav>