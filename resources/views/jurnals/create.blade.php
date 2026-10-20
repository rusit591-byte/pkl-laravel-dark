@extends('layouts.app')

@section('title', 'Tambah Jurnal - PKL Laravel')
@section('header_title', 'Tambah Jurnal Baru')

@section('content')
<div class="bg-cardSurface border border-borderSubtle rounded-xl p-5 shadow-lg">
    <div class="mb-4">
        <span class="text-[9px] uppercase font-semibold bg-emerald-950 text-accentGreen border border-emerald-900 px-2 py-0.5 rounded">Form Input</span>
        <h2 class="text-sm font-bold text-white mt-1.5">Catat Kegiatan Harian PKL</h2>
        <p class="text-[11px] text-gray-400">Masukkan rincian aktivitas dan progres pekerjaan Anda.</p>
    </div>

    <form action="{{ route('jurnals.store') }}" method="POST" class="space-y-3.5">
        @csrf

        <div>
            <label class="block text-[11px] font-semibold text-gray-300 mb-1">Tanggal</label>
            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full bg-appBg border border-borderSubtle rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>
        </div>

        <div>
            <label class="block text-[11px] font-semibold text-gray-300 mb-1">Judul Kegiatan</label>
            <input type="text" name="judul" placeholder="Contoh: Implementasi Database Laravel..." class="w-full bg-appBg border border-borderSubtle rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>
        </div>

        <div>
            <label class="block text-[11px] font-semibold text-gray-300 mb-1">Deskripsi / Uraian</label>
            <textarea name="deskripsi" rows="3" placeholder="Tuliskan detail pekerjaan..." class="w-full bg-appBg border border-borderSubtle rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required></textarea>
        </div>

        <div>
            <label class="block text-[11px] font-semibold text-gray-300 mb-1">Status Pekerjaan</label>
            <select name="status" class="w-full bg-appBg border border-borderSubtle rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen">
                <option value="todo">Todo</option>
                <option value="proses" selected>Proses</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>

        <div>
            <label class="block text-[11px] font-semibold text-gray-300 mb-1">Kendala (Opsional)</label>
            <input type="text" name="kendala" placeholder="Kendala jika ada..." class="w-full bg-appBg border border-borderSubtle rounded-lg px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen">
        </div>

        <div class="flex gap-2.5 pt-2">
            <button type="submit" class="flex-1 bg-accentGreen hover:bg-green-400 text-slate-950 font-bold py-2 rounded-lg text-xs transition shadow-md">
                Simpan Jurnal
            </button>
            <a href="{{ route('jurnals.index') }}" class="px-3.5 py-2 bg-appBg border border-borderSubtle text-gray-300 text-xs rounded-lg text-center hover:text-white transition">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection