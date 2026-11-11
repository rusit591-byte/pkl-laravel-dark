@extends('layouts.app')

@section('title', 'Dashboard Ringkasan - Portal PKL')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5">
        <h1 class="text-lg font-bold text-white">Dashboard Ringkasan PKL</h1>
        <p class="text-xs text-gray-400 mt-0.5">
            {{ auth()->user()->role === 'pembimbing' ? 'Monitor keseluruhan aktivitas dan rekapitulasi peserta.' : 'Ringkasan progres kegiatan harian Anda.' }}
        </p>
    </div>

    <!-- Statistik Utama (Grid Cards) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
        <!-- Total Jurnal -->
        <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5 space-y-2">
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Total Jurnal</p>
            <h2 class="text-2xl font-black text-white">{{ $totalJurnal }}</h2>
            <p class="text-[10px] text-gray-500">Keseluruhan catatan tercatat</p>
        </div>

        <!-- Jurnal 7 Hari Terakhir -->
        <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5 space-y-2">
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">7 Hari Terakhir</p>
            <h2 class="text-2xl font-black text-accentGreen">{{ $jurnal7Hari }}</h2>
            <p class="text-[10px] text-gray-500">Aktivitas dalam seminggu ke belakang</p>
        </div>

        <!-- Status Selesai -->
        <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5 space-y-2">
            <p class="text-xs text-gray-400 font-semibold uppercase tracking-wider">Status Selesai</p>
            <h2 class="text-2xl font-black text-emerald-400">{{ $statusCounts['Selesai'] ?? 0 }}</h2>
            <p class="text-[10px] text-gray-500">Pekerjaan berstatus tuntas</p>
        </div>
    </div>

    <!-- Detail Agregasi (Status & Kategori) -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
        <!-- Berdasarkan Status -->
        <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5 space-y-3">
            <h3 class="text-sm font-bold text-white">Rekap Berdasarkan Status</h3>
            <div class="space-y-2">
                @foreach(['Proses', 'Selesai', 'Revisi'] as $st)
                    <div class="flex justify-between items-center bg-appBg border border-borderSubtle p-3 rounded text-xs">
                        <span class="text-gray-300 font-medium">{{ $st }}</span>
                        <span class="font-bold px-2 py-0.5 rounded bg-emerald-950 text-accentGreen border border-emerald-900">
                            {{ $statusCounts[$st] ?? 0 }} Jurnal
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Berdasarkan Kategori -->
        <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5 space-y-3">
            <h3 class="text-sm font-bold text-white">Rekap Berdasarkan Kategori</h3>
            <div class="space-y-2">
                @forelse($kategoriCounts as $item)
                    <div class="flex justify-between items-center bg-appBg border border-borderSubtle p-3 rounded text-xs">
                        <span class="text-gray-300 font-medium">{{ $item->kategori->nama ?? 'Tanpa Kategori' }}</span>
                        <span class="font-bold text-white">{{ $item->total }} Jurnal</span>
                    </div>
                @empty
                    <p class="text-xs text-gray-500 italic">Belum ada data kategori.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection