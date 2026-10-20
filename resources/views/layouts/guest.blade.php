<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'PKL Laravel') }}</title>

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
                            accentGreen: '#4ade80',
                        }
                    }
                }
            }
        </script>
    </head>
    <body class="bg-darkBg text-gray-100 font-sans antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-darkBg">
            <div>
                <a href="/" class="text-xl font-bold text-white flex items-center gap-2">
                    <span class="w-3 h-3 rounded-full bg-accentGreen"></span> PKL Laravel
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-6 bg-cardBg border border-darkBorder shadow-xl overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>