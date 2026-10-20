@extends('layouts.app')

@section('title', 'Jurnal Harian PKL')
@section('header_title', 'Jurnal Harian')

@section('content')
<div class="space-y-4">
    <div class="flex justify-between items-center bg-darkSurface border border-darkBorder rounded-lg p-4">
        <div>
            <h2 class="text-sm font-bold text-white">Dokumentasi Kegiatan PKL</h2>
            <p class="text-xs text-gray-400">Catat seluruh progres harianmu di sini.</p>
        </div>
        <a href="{{ route('jurnals.create') }}" class="bg-accentGreen hover:bg-green-400 text-slate-950 text-xs font-bold px-3 py-2 rounded transition">
            + Tambah Jurnal
        </a>
    </div>

    @if(session('success'))
        <div class="bg-emerald-950 border border-emerald-800 text-accentGreen text-xs p-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-darkSurface border border-darkBorder rounded-lg divide-y divide-darkBorder">
        @forelse($jurnals as $jurnal)
            <div class="p-4 flex items-center justify-between">
                <div>
                    <span class="text-[10px] uppercase font-semibold px-2 py-0.5 rounded {{ $jurnal->status == 'selesai' ? 'bg-emerald-950 text-accentGreen border border-emerald-800' : ($jurnal->status == 'proses' ? 'bg-yellow-950 text-yellow-400 border border-yellow-800' : 'bg-gray-800 text-gray-300') }}">
                        {{ $jurnal->status }}
                    </span>
                    <h3 class="text-sm font-semibold text-white mt-1.5">{{ $jurnal->judul }}</h3>
                    <p class="text-xs text-gray-400 mt-0.5">{{ $jurnal->tanggal }} — {{ Str::limit($jurnal->deskripsi, 60) }}</p>
                </div>
                <div class="flex items-center gap-2">
                    <a href="{{ route('jurnals.edit', $jurnal->id) }}" class="text-xs bg-darkBase border border-darkBorder text-gray-300 px-2.5 py-1.5 rounded hover:text-white">Ubah</a>
                    <form action="{{ route('jurnals.destroy', $jurnal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jurnal ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-xs bg-red-950/60 border border-red-900 text-red-400 px-2.5 py-1.5 rounded hover:bg-red-900">Hapus</button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-6 text-center text-xs text-gray-500">
                Belum ada catatan jurnal harian. Silakan tambah data baru.
            </div>
        @endforelse
    </div>
</div>
@endsection