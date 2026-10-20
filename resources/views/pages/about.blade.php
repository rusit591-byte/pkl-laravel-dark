@extends('layouts.app')

@section('title', 'Tentang - PKL Laravel')
@section('header_title', 'Tentang Program PKL')

@section('content')
<div class="space-y-4">
    <div class="bg-cardSurface rounded-xl p-5 border border-borderSubtle">
        <span class="text-[9px] uppercase font-semibold bg-emerald-950 text-accentGreen border border-emerald-900 px-2.5 py-0.5 rounded">Informasi PKL</span>
        <h2 class="text-sm font-bold text-white mt-2 mb-1">Tentang Program PKL</h2>
        <p class="text-gray-400 text-xs leading-relaxed">
            Program Praktik Kerja Lapangan (PKL) di PT Metanouva Informatika difokuskan pada penguasaan framework Laravel modern, berpindah dari paradigma PHP native ke arsitektur MVC yang aman dan terstruktur.
        </p>
    </div>

    <div class="bg-cardSurface rounded-xl border border-borderSubtle divide-y divide-borderSubtle overflow-hidden">
        <div class="p-4 flex items-start gap-3">
            <span class="text-accentGreen font-mono font-bold text-xs">01</span>
            <div>
                <h3 class="text-xs font-semibold text-white">Routing Terpusat</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Menggantikan file <code>index.php</code> manual dengan definisi route yang rapi.</p>
            </div>
        </div>
        <div class="p-4 flex items-start gap-3">
            <span class="text-accentGreen font-mono font-bold text-xs">02</span>
            <div>
                <h3 class="text-xs font-semibold text-white">Logika Bisnis</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Memisahkan pemrosesan logika dari tampilan visual secara konsisten.</p>
            </div>
        </div>
        <div class="p-4 flex items-start gap-3">
            <span class="text-accentGreen font-mono font-bold text-xs">03</span>
            <div>
                <h3 class="text-xs font-semibold text-white">Blade Templating</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Menggantikan <code>include</code> manual dengan sistem inheritance layout yang bersih.</p>
            </div>
        </div>
    </div>
</div>
@endsection