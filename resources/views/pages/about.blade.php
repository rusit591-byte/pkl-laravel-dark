@extends('layouts.app')

@section('title', 'Tentang - PKL Laravel')

@section('content')
<div class="max-w-4xl mx-auto space-y-5">
    
    <!-- Header Tentang -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-6">
        <h1 class="text-lg font-bold text-white">Tentang Program PKL</h1>
        <p class="text-xs text-gray-400 mt-1 leading-relaxed">
            Praktik Kerja Lapangan (PKL) di PT Metanouva Informatika berfokus pada transisi pengembangan dari PHP Native menuju penguasaan framework Laravel modern dengan arsitektur MVC yang terstandarisasi industri.
        </p>
    </div>

    <!-- Poin-Poin Konsep -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg divide-y divide-borderSubtle overflow-hidden">
        
        <div class="p-4 flex items-start gap-4">
            <span class="text-accentGreen font-mono font-bold text-sm">01</span>
            <div>
                <h3 class="text-xs font-semibold text-white">Routing Terpusat</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Pengelolaan rute aplikasi yang bersih dan terstruktur menggunakan sistem route bawaan Laravel.</p>
            </div>
        </div>

        <div class="p-4 flex items-start gap-4">
            <span class="text-accentGreen font-mono font-bold text-sm">02</span>
            <div>
                <h3 class="text-xs font-semibold text-white">Logika Bisnis & MVC</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Pemisahan tegas antara pengelolaan data di Controller/Model dengan antarmuka tampilan Blade.</p>
            </div>
        </div>

        <div class="p-4 flex items-start gap-4">
            <span class="text-accentGreen font-mono font-bold text-sm">03</span>
            <div>
                <h3 class="text-xs font-semibold text-white">Keamanan & Autentikasi</h3>
                <p class="text-[11px] text-gray-400 mt-0.5">Penerapan middleware autentikasi dan isolasi data per pengguna agar akun tetap aman dan privat.</p>
            </div>
        </div>

    </div>

</div>
@endsection