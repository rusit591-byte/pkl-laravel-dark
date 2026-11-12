<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Portal PKL - Jurnal Harian')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        appBg: '#121212',
                        cardSurface: '#1a1a1a',
                        borderSubtle: '#2a2a2a',
                        accentGreen: '#4ade80',
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #121212; color: #e5e7eb; }
    </style>
</head>
<body class="min-h-screen flex flex-col font-sans antialiased">

    <!-- Navbar Atas -->
    <nav class="bg-cardSurface border-b border-borderSubtle sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-14">
                
                <!-- Logo & Menu Navigasi -->
                <div class="flex items-center gap-6">
                    <a href="{{ route('home') }}" class="flex items-center gap-2">
                        <span class="w-2.5 h-2.5 rounded-full bg-accentGreen"></span>
                        <span class="font-bold text-white text-sm tracking-wide">PKL Laravel</span>
                    </a>

                    <div class="hidden md:flex items-center gap-1 text-xs">
                        <!-- Beranda (Sekarang bisa diklik) -->
                        <a href="{{ route('home') }}" class="px-3 py-1.5 rounded-md transition {{ request()->routeIs('home') ? 'bg-appBg text-accentGreen font-semibold border border-borderSubtle' : 'text-gray-400 hover:text-white' }}">
                            Beranda
                        </a>

                        @auth
                            <!-- Dashboard (Ditambahkan agar bisa diakses dari navbar) -->
                            <a href="{{ route('dashboard') }}" class="px-3 py-1.5 rounded-md transition {{ request()->routeIs('dashboard') ? 'bg-appBg text-accentGreen font-semibold border border-borderSubtle' : 'text-gray-400 hover:text-white' }}">
                                Dashboard
                            </a>

                            @if(Auth::user()->role === 'pembimbing')
                                <a href="{{ route('pembimbing.jurnals') }}" class="px-3 py-1.5 rounded-md transition {{ request()->routeIs('pembimbing.jurnals*') ? 'bg-appBg text-accentGreen font-semibold border border-borderSubtle' : 'text-gray-400 hover:text-white' }}">
                                    Monitoring Jurnal
                                </a>
                            @else
                                <a href="{{ route('jurnals.index') }}" class="px-3 py-1.5 rounded-md transition {{ request()->routeIs('jurnals*') ? 'bg-appBg text-accentGreen font-semibold border border-borderSubtle' : 'text-gray-400 hover:text-white' }}">
                                    Jurnal Harian
                                </a>
                            @endif
                        @endauth

                        <a href="{{ route('about') }}" class="px-3 py-1.5 rounded-md transition {{ request()->routeIs('about') ? 'bg-appBg text-accentGreen font-semibold border border-borderSubtle' : 'text-gray-400 hover:text-white' }}">
                            Tentang
                        </a>
                        <a href="{{ route('contact') }}" class="px-3 py-1.5 rounded-md transition {{ request()->routeIs('contact') ? 'bg-appBg text-accentGreen font-semibold border border-borderSubtle' : 'text-gray-400 hover:text-white' }}">
                            Kontak
                        </a>
                    </div>
                </div>

                <!-- Bagian User / Auth -->
                <div class="flex items-center gap-3">
                    @auth
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 bg-appBg border border-borderSubtle hover:border-accentGreen px-3 py-1.5 rounded-md transition">
                            <span class="w-5 h-5 rounded-full bg-emerald-950 text-accentGreen flex items-center justify-center text-[10px] font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </span>
                            <span class="text-xs text-gray-300 font-medium">{{ Auth::user()->name }}</span>
                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-xs text-red-400 bg-appBg border border-borderSubtle px-3 py-1.5 rounded-md hover:bg-red-950/40 transition">
                                Keluar
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="text-xs text-gray-300 px-3 py-1.5 rounded-md hover:text-white transition">Masuk</a>
                        <a href="{{ route('register') }}" class="text-xs text-slate-950 bg-accentGreen font-bold px-3 py-1.5 rounded-md hover:bg-green-400 transition">Daftar</a>
                    @endauth
                </div>

            </div>
        </div>
    </nav>

    <!-- Konten Utama -->
    <main class="flex-1 max-w-6xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-cardSurface border-t border-borderSubtle py-4 text-center text-xs text-gray-500">
        &copy; {{ date('Y') }} PT Metanouva Informatika — Portal Jurnal PKL
    </footer>

</body>
</html>