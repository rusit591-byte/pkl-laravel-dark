@extends('layouts.app')

@section('title', 'Jurnal Harian - PKL Laravel')

@section('content')
<div class="space-y-4">
    
    <!-- Header Card ala Referensi -->
    <div class="bg-darkSurface border border-darkBorder rounded-xl p-4 flex justify-between items-center">
        <div>
            <span class="text-[10px] bg-emerald-950 text-accentGreen border border-emerald-900 px-2.5 py-0.5 rounded uppercase font-semibold tracking-wider">Minggu II</span>
            <h2 class="text-base font-bold text-white mt-1">Jurnal Harian PKL</h2>
            <p class="text-xs text-gray-400">Dokumentasi dan rekapitulasi kegiatan harian peserta.</p>
        </div>
        <a href="{{ route('jurnals.create') }}" class="bg-accentGreen hover:bg-green-400 text-slate-950 text-xs font-bold px-3.5 py-2 rounded-lg transition shadow-md flex items-center gap-1.5">
            <span class="text-base leading-none">+</span> Tambah
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-950/80 border border-emerald-900 text-accentGreen text-xs p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- List Data Model Card Datar (Terinspirasi Gambar Referensi) -->
    <div class="bg-darkSurface border border-darkBorder rounded-xl divide-y divide-darkBorder overflow-hidden">
        @forelse($jurnals as $jurnal)
            <div class="p-4 flex items-center justify-between hover:bg-darkBase/40 transition">
                <div class="space-y-1">
                    <div class="flex items-center gap-2">
                        <span class="text-[10px] uppercase font-semibold px-2 py-0.5 rounded {{ $jurnal->status == 'selesai' ? 'bg-emerald-950 text-accentGreen border border-emerald-800' : ($jurnal->status == 'proses' ? 'bg-yellow-950 text-yellow-400 border border-yellow-800' : 'bg-zinc-800 text-gray-300') }}">
                            {{ $jurnal->status }}
                        </span>
                        <span class="text-xs text-gray-400">{{ $jurnal->tanggal }}</span>
                    </div>
                    <h3 class="text-sm font-semibold text-white">{{ $jurnal->judul }}</h3>
                    <p class="text-xs text-gray-400">{{ Str::limit($jurnal->deskripsi, 70) }}</p>
                </div>
                
                <div class="flex items-center gap-2">
                    <a href="{{ route('jurnals.edit', $jurnal->id) }}" class="text-xs bg-darkBase border border-darkBorder text-gray-300 px-3 py-1.5 rounded hover:text-white transition">Ubah</a>
                    <form action="{{ route('jurnals.destroy', $jurnal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jurnal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs bg-red-950/50 border border-red-900/60 text-red-400 px-3 py-1.5 rounded hover:bg-red-900 transition">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-xs text-gray-500">
                Tidak ada catatan jurnal pada akun ini. Silakan buat catatan baru.
            </div>
        @endforelse
    </div>

</div>
@endsection