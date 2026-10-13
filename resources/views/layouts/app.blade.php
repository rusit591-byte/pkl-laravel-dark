<!DOCTYPE html>
<html lang="id" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PKL Laravel - Dark Theme')</title>
    <!-- Menggunakan CDN Tailwind CSS untuk kemudahan styling Dark Mode -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        darkBg: '#0f172a',      /* Slate 900 */
                        cardBg: '#1e293b',      /* Slate 800 */
                        accentColor: '#38bdf8', /* Sky 400 */
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-darkBg text-gray-100 min-h-screen flex flex-col font-sans">

    <!-- Header / Navbar -->
    <header class="bg-cardBg border-b border-gray-700 shadow-lg sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="text-xl font-bold text-accentColor flex items-center gap-2">
                ⚡ PKL Laravel
            </a>
            <nav class="space-x-6">
                <a href="{{ route('home') }}" class="hover:text-accentColor transition {{ request()->routeIs('home') ? 'text-accentColor font-semibold border-b-2 border-accentColor pb-1' : 'text-gray-300' }}">Beranda</a>
                <a href="{{ route('about') }}" class="hover:text-accentColor transition {{ request()->routeIs('about') ? 'text-accentColor font-semibold border-b-2 border-accentColor pb-1' : 'text-gray-300' }}">Tentang</a>
                <a href="{{ route('contact') }}" class="hover:text-accentColor transition {{ request()->routeIs('contact') ? 'text-accentColor font-semibold border-b-2 border-accentColor pb-1' : 'text-gray-300' }}">Kontak</a>
            </nav>
        </div>
    </header>

    <!-- Content Utama -->
    <main class="flex-grow max-w-6xl w-full mx-auto px-4 py-8">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-cardBg border-t border-gray-800 py-6 text-center text-sm text-gray-400">
        <p>&copy; 2026 PT Metanouva Informatika — Program PKL Laravel (Tema Dark)</p>
    </footer>

</body>
</html>