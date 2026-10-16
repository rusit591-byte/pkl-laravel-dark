@extends('layouts.app')

@section('title', 'Tentang - PKL Laravel')

@section('content')
<div class="space-y-4">
    <div class="bg-cardBg rounded-lg p-5 border border-gray-800">
        <h2 class="text-lg font-bold text-white mb-2">Tentang Program PKL</h2>
        <p class="text-gray-400 text-sm leading-relaxed">
            Program Praktik Kerja Lapangan (PKL) di PT Metanouva Informatika difokuskan pada penguasaan framework Laravel modern, berpindah dari paradigma PHP native ke arsitektur MVC yang aman dan terstruktur.
        </p>
    </div>

    <div class="bg-cardBg rounded-lg border border-gray-800 divide-y divide-gray-800">
        <div class="p-4 flex items-start gap-3">
            <span class="text-accentColor font-mono font-bold text-sm">01</span>
            <div>
                <h3 class="text-sm font-semibold text-white">Routing Terpusat</h3>
                <p class="text-xs text-gray-400 mt-0.5">Menggantikan file `index.php` manual dengan definisi route yang rapi.</p>
            </div>
        </div>
        <div class="p-4 flex items-start gap-3">
            <span class="text-accentColor font-mono font-bold text-sm">02</span>
            <div>
                <h3 class="text-sm font-semibold text-white">Logika Bisnis</h3>
                <p class="text-xs text-gray-400 mt-0.5">Memisahkan pemrosesan logika dari tampilan visual secara konsisten.</p>
            </div>
        </div>
        <div class="p-4 flex items-start gap-3">
            <span class="text-accentColor font-mono font-bold text-sm">03</span>
            <div>
                <h3 class="text-sm font-semibold text-white">Blade Templating</h3>
                <p class="text-xs text-gray-400 mt-0.5">Menggantikan `include` manual dengan sistem inheritance layout yang bersih.</p>
            </div>
        </div>
    </div>
</div>
@endsection