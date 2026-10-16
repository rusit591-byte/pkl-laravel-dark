<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PKL Laravel - Dark Theme')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        darkBg: '#121212',      /* Background utama lebih gelap minimalis */
                        cardBg: '#1e1e1e',      /* Background card ala list */
                        accentColor: '#4ade80', /* Aksen hijau soft yang bersih */
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-darkBg text-gray-100 min-h-screen flex flex-col font-sans">

    <!-- Header / Navbar -->
    <header class="bg-cardBg border-b border-gray-800 shadow-sm sticky top-0 z-50">
        <div class="max-w-4xl mx-auto px-4 py-3.5 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-base font-bold text-white flex items-center gap-2">
                <span class="w-2.5 h-2.5 rounded-full bg-accentColor"></span> PKL Laravel
            </a>
            <nav class="space-x-4 text-sm font-medium">
                <a href="{{ route('home') }}" class="transition {{ request()->routeIs('home') ? 'text-accentColor border-b-2 border-accentColor pb-1' : 'text-gray-400 hover:text-gray-200' }}">Beranda</a>
                <a href="{{ route('about') }}" class="transition {{ request()->routeIs('about') ? 'text-accentColor border-b-2 border-accentColor pb-1' : 'text-gray-400 hover:text-gray-200' }}">Tentang</a>
                <a href="{{ route('contact') }}" class="transition {{ request()->routeIs('contact') ? 'text-accentColor border-b-2 border-accentColor pb-1' : 'text-gray-400 hover:text-gray-200' }}">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- Content Utama -->
    <main class="flex-grow max-w-4xl w-full mx-auto px-4 py-6">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-cardBg border-t border-gray-800 py-4 text-center text-xs text-gray-500">
        <p>&copy; 2026 PT Metanouva Informatika — Program PKL Laravel</p>
    </footer>

</body>
</html>