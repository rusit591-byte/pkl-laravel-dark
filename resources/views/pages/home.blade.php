@extends('layouts.app')

@section('title', 'Beranda - PKL Laravel')

@section('content')
<div class="bg-cardBg rounded-xl p-8 border border-gray-700 shadow-2xl text-center my-8">
    <span class="bg-sky-900 text-sky-300 text-xs font-medium px-3 py-1 rounded-full uppercase tracking-wider">Minggu I PKL</span>
    <h1 class="text-4xl font-extrabold mt-4 mb-3 text-white">Selamat Datang di Portal PKL Laravel</h1>
    <p class="text-gray-400 max-w-2xl mx-auto mb-6">
        Proyek transisi dari PHP Native menuju Framework Laravel dengan antarmuka bertema gelap (*Dark Mode*).
    </p>
    <div class="flex justify-center gap-4">
        <a href="{{ route('about') }}" class="bg-sky-500 hover:bg-sky-600 text-slate-900 font-bold px-6 py-2.5 rounded-lg transition shadow-md">Pelajari Lebih Lanjut</a>
        <a href="{{ route('contact') }}" class="bg-gray-700 hover:bg-gray-600 text-white font-semibold px-6 py-2.5 rounded-lg transition border border-gray-600">Hubungi Kami</a>
    </div>
</div>
@endsection