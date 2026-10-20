@extends('layouts.app')

@section('title', 'Jurnal Harian')
@section('header_title', 'Rekapitulasi Jurnal')

@section('content')
<div class="space-y-4">
    
    <!-- Sub-Tab Menu Navigasi Horizontal ala Gambar Referensi -->
    <div class="flex border-b border-borderSubtle text-xs font-medium text-gray-400 overflow-x-auto">
        <span class="py-2.5 px-3 text-accentGreen border-b-2 border-accentGreen">Harian</span>
        <span class="py-2.5 px-3 hover:text-white cursor-pointer">Kalender</span>
        <span class="py-2.5 px-3 hover:text-white cursor-pointer">Bulanan</span>
        <span class="py-2.5 px-3 hover:text-white cursor-pointer">Tutup Buku</span>
    </div>

    <!-- Kotak Ringkasan Statistik (Pendapatan & Pengeluaran / Total Kegiatan) -->
    <div class="bg-cardSurface border border-borderSubtle rounded-xl p-3.5 flex justify-between items-center text-xs">
        <div>
            <p class="text-gray-400">Total Kegiatan</p>
            <p class="text-white font-bold text-sm mt-0.5">{{ count($jurnals) }} Sesi</p>
        </div>
        <div class="text-right">
            <p class="text-gray-400">Status Selesai</p>
            <p class="text-accentGreen font-bold text-sm mt-0.5">
                {{ $jurnals->where('status', 'selesai')->count() }} Selesai
            </p>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-950/80 border border-emerald-900 text-accentGreen text-xs p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Daftar List Jurnal Bergaris Tipis ala Card Referensi -->
    <div class="bg-cardSurface border border-borderSubtle rounded-xl divide-y divide-borderSubtle overflow-hidden">
        @forelse($jurnals as $jurnal)
            <div class="p-3.5 flex items-center justify-between hover:bg-appBg/50 transition">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-[9px] uppercase font-bold px-1.5 py-0.5 rounded {{ $jurnal->status == 'selesai' ? 'bg-emerald-950 text-accentGreen border border-emerald-900' : ($jurnal->status == 'proses' ? 'bg-yellow-950 text-yellow-400 border border-yellow-900' : 'bg-zinc-800 text-gray-300') }}">
                            {{ $jurnal->status }}
                        </span>
                        <span class="text-[11px] text-gray-400">{{ $jurnal->tanggal }}</span>
                    </div>
                    <h3 class="text-xs font-semibold text-white">{{ $jurnal->judul }}</h3>
                    <p class="text-[11px] text-gray-400">{{ Str::limit($jurnal->deskripsi, 50) }}</p>
                </div>
                
                <div class="flex items-center gap-1.5">
                    <a href="{{ route('jurnals.edit', $jurnal->id) }}" class="text-[10px] bg-appBg border border-borderSubtle text-gray-300 px-2.5 py-1 rounded hover:text-white">Ubah</a>
                    <form action="{{ route('jurnals.destroy', $jurnal->id) }}" method="POST" onsubmit="return confirm('Hapus jurnal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-[10px] bg-red-950/40 border border-red-900/60 text-red-400 px-2.5 py-1 rounded">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-xs text-gray-500">
                Tidak ada transaksi atau jurnal pada periode ini.
            </div>
        @endforelse
    </div>

</div>
@endsection