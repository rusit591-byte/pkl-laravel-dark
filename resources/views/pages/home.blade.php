@extends('layouts.app')

@section('title', 'Beranda - PKL Laravel')

@section('content')
<div class="space-y-4">
    <div class="bg-cardBg rounded-lg p-5 border border-gray-800">
        <span class="text-xs font-semibold text-accentColor bg-emerald-950/60 border border-emerald-900 px-2.5 py-0.5 rounded">Minggu I PKL</span>
        <h1 class="text-2xl font-bold mt-2 mb-1 text-white">Portal PKL Laravel</h1>
        <p class="text-gray-400 text-sm">
            Proyek transisi dari PHP Native menuju Framework Laravel dengan antarmuka bertema gelap (*Dark Mode*).
        </p>
    </div>

    <div class="bg-cardBg rounded-lg border border-gray-800 divide-y divide-gray-800">
        <div class="p-4 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-white">Pelajari Lebih Lanjut</h3>
                <p class="text-xs text-gray-400">Pahami konsep dasar routing dan controller.</p>
            </div>
            <a href="{{ route('about') }}" class="bg-accentColor text-slate-950 text-xs font-bold px-3 py-1.5 rounded transition hover:bg-green-400">Buka</a>
        </div>
        <div class="p-4 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-white">Hubungi Kami</h3>
                <p class="text-xs text-gray-400">Kirimkan pertanyaan atau laporan progres.</p>
            </div>
            <a href="{{ route('contact') }}" class="bg-gray-800 text-gray-200 text-xs font-semibold px-3 py-1.5 rounded border border-gray-700 transition hover:bg-gray-700">Kontak</a>
        </div>
    </div>
</div>
@endsection