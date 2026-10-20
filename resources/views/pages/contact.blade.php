@extends('layouts.app')

@section('title', 'Kontak - PKL Laravel')
@section('header_title', 'Pusat Kontak')

@section('content')
<div class="space-y-4">
    <div class="bg-cardSurface border border-borderSubtle rounded-xl p-5 space-y-3">
        <span class="text-[9px] uppercase font-semibold bg-emerald-950 text-accentGreen border border-emerald-900 px-2.5 py-0.5 rounded">Dukungan</span>
        <h2 class="text-sm font-bold text-white">Hubungi Pembimbing & Instansi</h2>
        <p class="text-xs text-gray-400 leading-relaxed">
            Jika terdapat kendala teknis atau pertanyaan seputar laporan progres PKL di PT Metanouva Informatika, silakan gunakan informasi di bawah ini.
        </p>
    </div>

    <div class="bg-cardSurface border border-borderSubtle rounded-xl divide-y divide-borderSubtle overflow-hidden text-xs">
        <div class="p-4 flex justify-between items-center">
            <span class="text-gray-400">Instansi Penempatan</span>
            <span class="text-white font-medium">PT Metanouva Informatika</span>
        </div>
        <div class="p-4 flex justify-between items-center">
            <span class="text-gray-400">Wilayah / Lokasi</span>
            <span class="text-white font-medium">Belitung</span>
        </div>
        <div class="p-4 flex justify-between items-center">
            <span class="text-gray-400">Fase Proyek PKL</span>
            <span class="text-accentGreen font-semibold">Minggu II (Selesai & Stabil)</span>
        </div>
    </div>
</div>
@endsection