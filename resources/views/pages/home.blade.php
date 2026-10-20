@extends('layouts.app')

@section('title', 'Beranda - PKL Laravel')
@section('header_title', 'Beranda PKL')

@section('content')
<div class="space-y-4">
    <div class="bg-cardSurface rounded-xl p-4 border border-borderSubtle">
        <span class="text-[9px] font-semibold text-accentGreen bg-emerald-950/60 border border-emerald-900 px-2 py-0.5 rounded">Minggu II PKL</span>
        <h1 class="text-xl font-bold mt-2 mb-1 text-white">Portal PKL Laravel</h1>
        <p class="text-gray-400 text-xs leading-relaxed">
            Sistem manajemen jurnal harian PKL di PT Metanouva Informatika dengan antarmuka bertema gelap (*Dark Mode*).
        </p>
    </div>

    <div class="bg-cardSurface rounded-xl border border-borderSubtle divide-y divide-borderSubtle overflow-hidden">
        <div class="p-4 flex items-center justify-between">
            <div>
                <h3 class="text-xs font-semibold text-white">Kelola Jurnal Harian</h3>
                <p class="text-[11px] text-gray-400">Catat dan pantau progres tugas harian Anda.</p>
            </div>
            <a href="{{ route('jurnals.index') }}" class="bg-accentGreen text-slate-950 text-[11px] font-bold px-3 py-1.5 rounded transition hover:bg-green-400">Buka</a>
        </div>
        <div class="p-4 flex items-center justify-between">
            <div>
                <h3 class="text-xs font-semibold text-white">Tentang Aplikasi</h3>
                <p class="text-[11px] text-gray-400">Informasi pengembang dan sistem.</p>
            </div>
            <a href="{{ route('about') }}" class="bg-appBg text-gray-300 text-[11px] font-semibold px-3 py-1.5 rounded border border-borderSubtle transition hover:text-white">Lihat</a>
        </div>
    </div>
</div>
@endsection