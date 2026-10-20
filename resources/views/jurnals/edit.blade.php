@extends('layouts.app')

@section('title', 'Ubah Jurnal - PKL Laravel')

@section('content')
<div class="max-w-xl mx-auto bg-darkSurface border border-darkBorder rounded-xl p-6 shadow-xl">
    <div class="mb-4">
        <span class="text-[10px] uppercase font-semibold bg-emerald-950 text-accentGreen border border-emerald-900 px-2.5 py-0.5 rounded">Form Edit</span>
        <h2 class="text-lg font-bold text-white mt-1">Ubah Catatan Jurnal Harian</h2>
        <p class="text-xs text-gray-400">Perbarui informasi kegiatan PKL Anda.</p>
    </div>

    <form action="{{ route('jurnals.update', $jurnal->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label class="block text-xs font-semibold text-gray-300 mb-1">Tanggal</label>
            <input type="date" name="tanggal" value="{{ old('tanggal', $jurnal->tanggal) }}" class="w-full bg-darkBase border border-darkBorder rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-accentGreen" required>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-300 mb-1">Judul Kegiatan</label>
            <input type="text" name="judul" value="{{ old('judul', $jurnal->judul) }}" class="w-full bg-darkBase border border-darkBorder rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-accentGreen" required>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-300 mb-1">Deskripsi / Uraian</label>
            <textarea name="deskripsi" rows="3" class="w-full bg-darkBase border border-darkBorder rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-accentGreen" required>{{ old('deskripsi', $jurnal->deskripsi) }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-300 mb-1">Status Pekerjaan</label>
            <select name="status" class="w-full bg-darkBase border border-darkBorder rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-accentGreen">
                <option value="todo" {{ $jurnal->status == 'todo' ? 'selected' : '' }}>Todo</option>
                <option value="proses" {{ $jurnal->status == 'proses' ? 'selected' : '' }}>Proses</option>
                <option value="selesai" {{ $jurnal->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>

        <div>
            <label class="block text-xs font-semibold text-gray-300 mb-1">Kendala (Opsional)</label>
            <input type="text" name="kendala" value="{{ old('kendala', $jurnal->kendala) }}" class="w-full bg-darkBase border border-darkBorder rounded-lg px-3 py-2 text-sm text-white focus:outline-none focus:border-accentGreen" placeholder="Kendala jika ada...">
        </div>

        <div class="flex gap-3 pt-2">
            <button type="submit" class="flex-1 bg-accentGreen hover:bg-green-400 text-slate-950 font-bold py-2.5 rounded-lg text-sm transition shadow-md">
                Perbarui Jurnal
            </button>
            <a href="{{ route('jurnals.index') }}" class="px-4 py-2.5 bg-darkBase border border-darkBorder text-gray-300 text-sm rounded-lg text-center hover:text-white transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection