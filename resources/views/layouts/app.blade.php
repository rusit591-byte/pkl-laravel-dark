<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'PKL Laravel'))</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Tailwind CSS CDN + Konfigurasi Dark Minimalis -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            darkBg: '#121212',
                            cardBg: '#1e1e1e',
                            darkBorder: '#2a2a2a',
                            accentColor: '#4ade80',
                        }
                    }
                }
            }
        </script>

        <!-- Alpine.js untuk interaksi Dropdown Navigasi Breeze (Tanpa NPM) -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    </head>
    <body class="bg-darkBg text-gray-100 min-h-screen flex flex-col font-sans antialiased">
        <div class="min-h-screen bg-darkBg">
            <!-- Navigasi Bawaan Breeze -->
            @include('layouts.navigation')

            <!-- Header Halaman -->
            @isset($header)
                <header class="bg-cardBg border-b border-darkBorder shadow-sm">
                    <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 text-white font-semibold">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Konten Halaman -->
            <main class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                @if(isset($slot) && $slot->isNotEmpty())
                    {{ $slot }}
                @else
                    @yield('content')
                @endif
            </main>
        </div>
    </body>
</html>