@extends('layouts.app')

@section('title', 'Beranda - PKL Laravel')

@section('content')
<div class="max-w-4xl mx-auto space-y-5">
    
    <!-- Hero / Welcome Card -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-6">
        <span class="text-[10px] uppercase font-semibold bg-emerald-950 text-accentGreen border border-emerald-900 px-2.5 py-0.5 rounded">Program PKL PT Metanouva</span>
        <h1 class="text-xl font-bold text-white mt-2 mb-1.5">Portal Jurnal Harian PKL</h1>
        <p class="text-gray-400 text-xs leading-relaxed max-w-2xl">
            Sistem informasi berbasis Laravel 12 untuk mencatat dan memantau progres kegiatan harian PKL secara terstruktur, aman, dan efisien.
        </p>
    </div>

    <!-- Quick Menu / Navigation Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        
        <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5 flex flex-col justify-between space-y-4">
            <div>
                <h3 class="text-sm font-semibold text-white">Kelola Jurnal Harian</h3>
                <p class="text-xs text-gray-400 mt-1">Buat, ubah, dan pantau status seluruh catatan tugas harian Anda di sini.</p>
            </div>
            <div>
                <a href="{{ route('jurnals.index') }}" class="inline-block bg-accentGreen text-slate-950 text-xs font-bold px-4 py-2 rounded-md hover:bg-green-400 transition">
                    Buka Jurnal &rarr;
                </a>
            </div>
        </div>

        <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5 flex flex-col justify-between space-y-4">
            <div>
                <h3 class="text-sm font-semibold text-white">Tentang Sistem PKL</h3>
                <p class="text-xs text-gray-400 mt-1">Pelajari lebih lanjut mengenai arsitektur dan teknologi yang digunakan pada proyek ini.</p>
            </div>
            <div>
                <a href="{{ route('about') }}" class="inline-block bg-appBg border border-borderSubtle text-gray-300 text-xs font-semibold px-4 py-2 rounded-md hover:text-white transition">
                    Baca Selengkapnya &rarr;
                </a>
            </div>
        </div>

    </div>

</div>
@endsection