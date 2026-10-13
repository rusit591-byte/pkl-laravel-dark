@extends('layouts.app')

@section('title', 'Tentang - PKL Laravel')

@section('content')
<div class="space-y-6">
    <div class="bg-cardBg rounded-xl p-8 border border-gray-700 shadow-xl">
        <h2 class="text-2xl font-bold text-accentColor mb-4">Tentang Program PKL</h2>
        <p class="text-gray-300 leading-relaxed mb-4">
            Program Praktik Kerja Lapangan (PKL) di PT Metanouva Informatika difokuskan pada penguasaan framework Laravel modern, berpindah dari paradigma PHP native ke arsitektur MVC yang aman dan terstruktur.
        </p>
    </div>

    <div class="grid md:grid-cols-3 gap-6">
        <div class="bg-cardBg p-6 rounded-xl border border-gray-800">
            <div class="text-accentColor text-2xl mb-2">🛣️ Route</div>
            <h3 class="text-lg font-semibold text-white mb-1">Routing Terpusat</h3>
            <p class="text-sm text-gray-400">Menggantikan file `index.php` manual dengan definisi route yang rapi.</p>
        </div>
        <div class="bg-cardBg p-6 rounded-xl border border-gray-800">
            <div class="text-accentColor text-2xl mb-2">🕹️ Controller</div>
            <h3 class="text-lg font-semibold text-white mb-1">Logika Bisnis</h3>
            <p class="text-sm text-gray-400">Memisahkan pemrosesan logika dari tampilan visual secara konsisten.</p>
        </div>
        <div class="bg-cardBg p-6 rounded-xl border border-gray-800">
            <div class="text-accentColor text-2xl mb-2">🎨 Blade View</div>
            <h3 class="text-lg font-semibold text-white mb-1">Blade Templating</h3>
            <p class="text-sm text-gray-400">Menggantikan `include` manual dengan sistem inheritance layout yang bersih.</p>
        </div>
    </div>
</div>
@endsection