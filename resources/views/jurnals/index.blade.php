@extends('layouts.app')

@section('title', 'Jurnal Harian - PKL Laravel')

@section('content')
<div class="space-y-5">
    
    <!-- Header Halaman + Tombol Tambah Jurnal -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3 bg-cardSurface border border-borderSubtle rounded-lg p-5">
        <div>
            <h1 class="text-lg font-bold text-white">Jurnal Harian PKL</h1>
            <p class="text-xs text-gray-400 mt-0.5">Catatan rekapitulasi progres pekerjaan harian Anda.</p>
        </div>
        <div>
            <a href="{{ route('jurnals.create') }}" class="inline-flex items-center gap-2 bg-accentGreen hover:bg-green-400 text-slate-950 font-bold text-xs px-4 py-2 rounded-md transition">
                <span>+</span> Tambah Jurnal
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-emerald-950/80 border border-emerald-900 text-accentGreen text-xs p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Card Tabel / List Jurnal Ngotak Presisi -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg divide-y divide-borderSubtle overflow-hidden">
        @forelse($jurnals as $jurnal)
            <div class="p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-appBg/40 transition">
                <div class="space-y-1.5 flex-1">
                    <div class="flex items-center gap-2.5">
                        <span class="text-[10px] font-bold uppercase px-2 py-0.5 rounded border {{ $jurnal->status == 'selesai' ? 'bg-emerald-950 text-accentGreen border-emerald-900' : ($jurnal->status == 'proses' ? 'bg-yellow-950 text-yellow-400 border-yellow-900' : 'bg-zinc-800 text-gray-300 border-zinc-700') }}">
                            {{ $jurnal->status }}
                        </span>
                        <span class="text-xs text-gray-400 font-mono">{{ $jurnal->tanggal }}</span>
                    </div>
                    <h3 class="text-sm font-semibold text-white">{{ $jurnal->judul }}</h3>
                    <p class="text-xs text-gray-400 leading-relaxed">{{ $jurnal->deskripsi }}</p>
                    @if($jurnal->kendala)
                        <p class="text-[11px] text-red-400/90 italic">Kendala: {{ $jurnal->kendala }}</p>
                    @endif
                </div>
                
                <div class="flex items-center gap-2 self-end sm:self-center">
                    <a href="{{ route('jurnals.edit', $jurnal->id) }}" class="text-xs bg-appBg border border-borderSubtle text-gray-300 px-3 py-1.5 rounded-md hover:text-white transition">
                        Ubah
                    </a>
                    <form action="{{ route('jurnals.destroy', $jurnal->id) }}" method="POST" onsubmit="return confirm('Hapus jurnal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs bg-red-950/30 border border-red-900/60 text-red-400 px-3 py-1.5 rounded-md hover:bg-red-900/50 transition">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-xs text-gray-500">
                Belum ada catatan jurnal harian yang dibuat.
            </div>
        @endforelse
    </div>

</div>
@endsection