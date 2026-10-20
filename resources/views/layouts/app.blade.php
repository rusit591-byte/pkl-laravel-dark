<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PKL Laravel - Jurnal Harian')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        darkBase: '#121212',     /* Background utama gelap minimalis */
                        darkSurface: '#18181b',  /* Background card/container ala referensi */
                        darkBorder: '#27272a',   /* Warna border garis tipis */
                        accentGreen: '#4ade80',  /* Aksen hijau lembut */
                    }
                }
            }
        }
    </script>
    <!-- Alpine.js untuk interaksi dropdown/menu -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
<body class="bg-darkBase text-gray-100 min-h-screen flex flex-col font-sans antialiased">

    <!-- Navbar Atas Website -->
    <header class="bg-darkSurface border-b border-darkBorder sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 py-3.5 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-sm font-bold text-white tracking-wide flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-accentGreen"></span> Portal PKL Laravel
            </a>

            <nav class="hidden sm:flex items-center space-x-1 text-xs font-medium">
                <a href="{{ route('home') }}" class="px-3 py-1.5 rounded transition {{ request()->routeIs('home') ? 'bg-darkBorder text-accentGreen' : 'text-gray-400 hover:text-white' }}">Beranda</a>
                <a href="{{ route('about') }}" class="px-3 py-1.5 rounded transition {{ request()->routeIs('about') ? 'bg-darkBorder text-accentGreen' : 'text-gray-400 hover:text-white' }}">Tentang</a>
                <a href="{{ route('contact') }}" class="px-3 py-1.5 rounded transition {{ request()->routeIs('contact') ? 'bg-darkBorder text-accentGreen' : 'text-gray-400 hover:text-white' }}">Kontak</a>
                @auth
                    <a href="{{ route('jurnals.index') }}" class="px-3 py-1.5 rounded transition {{ request()->routeIs('jurnals*') ? 'bg-darkBorder text-accentGreen' : 'text-gray-400 hover:text-white' }}">Jurnal Harian</a>
                @endauth
            </nav>

            <!-- Bagian Auth Kanan -->
            <div class="flex items-center gap-2">
                @auth
                    <span class="text-xs text-gray-300 hidden md:inline">Halo, <strong class="text-white">{{ Auth::user()->name }}</strong></span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs bg-darkBase border border-darkBorder text-red-400 px-3 py-1.5 rounded hover:bg-red-950/40 transition">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-xs text-gray-300 px-3 py-1.5 rounded bg-darkBase border border-darkBorder hover:text-white transition">Masuk</a>
                    <a href="{{ route('register') }}" class="text-xs text-slate-950 font-bold bg-accentGreen px-3 py-1.5 rounded hover:bg-green-400 transition">Daftar</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Konten Utama -->
    <main class="flex-1 max-w-4xl w-full mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-darkSurface border-t border-darkBorder py-4 text-center text-xs text-gray-500">
        <p>&copy; 2026 PT Metanouva Informatika — Program PKL Laravel</p>
    </footer>

</body>
</html>