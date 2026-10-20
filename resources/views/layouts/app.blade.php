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
                        appBg: '#121212',          /* Background gelap pekat ala aplikasi */
                        cardSurface: '#1a1a1a',    /* Warna card / permukaan list */
                        borderSubtle: '#2a2a2a',   /* Warna garis pembatas tipis */
                        accentGreen: '#4ade80',    /* Hijau indikator */
                    }
                }
            }
        }
    </script>
    <style>
        body { background-color: #121212; color: #e5e7eb; }
    </style>
</head>
<body class="min-h-screen flex flex-col font-sans antialiased pb-20">

    <!-- Header Atas (Judul / Bulan & Tombol Aksi) -->
    <header class="bg-cardSurface border-b border-borderSubtle sticky top-0 z-40 px-4 py-3">
        <div class="max-w-md mx-auto flex items-center justify-between">
            <h1 class="text-base font-bold text-white tracking-wide">
                @yield('header_title', 'Jurnal Harian')
            </h1>
            <div class="flex items-center gap-2">
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-xs text-red-400 bg-appBg border border-borderSubtle px-2.5 py-1 rounded hover:bg-red-950/30">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-xs text-accentGreen font-semibold px-2.5 py-1 rounded bg-appBg border border-borderSubtle">Masuk</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Konten Utama (Dibatasi max-w-md agar proporsional seperti UI Mobile App di gambar) -->
    <main class="flex-1 max-w-md w-full mx-auto px-4 py-4">
        @yield('content')
    </main>

    <!-- Floating Action Button (Tombol Tambah "+" Mengambang di Kanan Bawah ala Referensi) -->
    @auth
    <div class="fixed bottom-20 right-4 z-40 max-w-md w-full mx-auto flex justify-end pointer-events-none">
        <a href="{{ route('jurnals.create') }}" class="pointer-events-auto bg-white text-slate-950 w-12 h-12 rounded-full flex items-center justify-center shadow-2xl font-bold text-2xl hover:bg-gray-200 transition">
            +
        </a>
    </div>
    @endauth

    <!-- Bottom Navigation Bar (Identik dengan menu bawah di gambar referensi) -->
    <nav class="fixed bottom-0 left-0 right-0 bg-cardSurface border-t border-borderSubtle z-50">
        <div class="max-w-md mx-auto flex justify-around items-center py-2.5">
            
            <!-- Tab Transaksi / Jurnal -->
            <a href="{{ route('jurnals.index') }}" class="flex flex-col items-center gap-1 group">
                <svg class="w-5 h-5 {{ request()->routeIs('jurnals*') ? 'text-accentGreen' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012-2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/>
                </svg>
                <span class="text-[10px] font-medium {{ request()->routeIs('jurnals*') ? 'text-accentGreen' : 'text-gray-400' }}">Jurnal</span>
            </a>

            <!-- Tab Beranda / Aset -->
            <a href="{{ route('home') }}" class="flex flex-col items-center gap-1 group">
                <svg class="w-5 h-5 {{ request()->routeIs('home') ? 'text-accentGreen' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 00-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
                <span class="text-[10px] font-medium {{ request()->routeIs('home') ? 'text-accentGreen' : 'text-gray-400' }}">Beranda</span>
            </a>

            <!-- Tab Tentang -->
            <a href="{{ route('about') }}" class="flex flex-col items-center gap-1 group">
                <svg class="w-5 h-5 {{ request()->routeIs('about') ? 'text-accentGreen' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="text-[10px] font-medium {{ request()->routeIs('about') ? 'text-accentGreen' : 'text-gray-400' }}">Tentang</span>
            </a>

            <!-- Tab Kontak / Lainnya -->
            <a href="{{ route('contact') }}" class="flex flex-col items-center gap-1 group">
                <svg class="w-5 h-5 {{ request()->routeIs('contact') ? 'text-accentGreen' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                <span class="text-[10px] font-medium {{ request()->routeIs('contact') ? 'text-accentGreen' : 'text-gray-400' }}">Kontak</span>
            </a>

        </div>
    </nav>

</body>
</html>