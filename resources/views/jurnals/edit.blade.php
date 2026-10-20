@extends('layouts.app')

@section('title', 'Ubah Jurnal - PKL Laravel')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">
    
    <!-- Header Form -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5">
        <h1 class="text-lg font-bold text-white">Ubah Jurnal Harian</h1>
        <p class="text-xs text-gray-400 mt-0.5">Perbarui informasi catatan kegiatan PKL Anda.</p>
    </div>

    <!-- Card Form -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-6">
        <form action="{{ route('jurnals.update', $jurnal->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Tanggal Kegiatan</label>
                <input type="date" name="tanggal" value="{{ old('tanggal', $jurnal->tanggal) }}" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Judul Kegiatan</label>
                <input type="text" name="judul" value="{{ old('judul', $jurnal->judul) }}" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Deskripsi / Uraian Tugas</label>
                <textarea name="deskripsi" rows="4" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>{{ old('deskripsi', $jurnal->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Status Pekerjaan</label>
                <select name="status" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen">
                    <option value="todo" {{ $jurnal->status == 'todo' ? 'selected' : '' }}>Todo</option>
                    <option value="proses" {{ $jurnal->status == 'proses' ? 'selected' : '' }}>Proses</option>
                    <option value="selesai" {{ $jurnal->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Kendala (Opsional)</label>
                <input type="text" name="kendala" value="{{ old('kendala', $jurnal->kendala) }}" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen">
            </div>

            <div class="flex items-center gap-3 pt-3">
                <button type="submit" class="bg-accentGreen hover:bg-green-400 text-slate-950 font-bold text-xs px-5 py-2.5 rounded-md transition shadow-md">
                    Perbarui Jurnal
                </button>
                <a href="{{ route('jurnals.index') }}" class="bg-appBg border border-borderSubtle text-gray-300 text-xs px-4 py-2.5 rounded-md hover:text-white transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection