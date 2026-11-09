@extends('layouts.app')

@section('title', 'Tambah Jurnal - Portal PKL')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5">
        <h1 class="text-lg font-bold text-white">Tambah Jurnal Harian</h1>
        <p class="text-xs text-gray-400 mt-0.5">Catat progres kegiatan PKL harian Anda di sini.</p>
    </div>

    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-6">
        <form action="{{ route('jurnals.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <!-- Judul -->
            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Judul Kegiatan</label>
                <input type="text" name="judul" value="{{ old('judul') }}" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>
            </div>

            <!-- Kategori (Baru) -->
            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Kategori</label>
                <select name="kategori_id" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ old('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal & Status -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1">Tanggal</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal', date('Y-m-d')) }}" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1">Status</label>
                    <select name="status" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>
                        <option value="Proses">Proses</option>
                        <option value="Selesai">Selesai</option>
                        <option value="Revisi">Revisi</option>
                    </select>
                </div>
            </div>

            <!-- Deskripsi -->
            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Deskripsi Pekerjaan</label>
                <textarea name="deskripsi" rows="4" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>{{ old('deskripsi') }}</textarea>
            </div>

            <!-- Upload Lampiran (Baru) -->
            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Lampiran / Bukti Kegiatan (Opsional)</label>
                <input type="file" name="lampiran" class="text-xs text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-appBg file:text-accentGreen hover:file:bg-emerald-950 file:border-borderSubtle file:border cursor-pointer">
                <p class="text-[10px] text-gray-500 mt-1">Format: JPG, PNG, PDF. Maksimal 2MB.</p>
            </div>

            <!-- Tombol Aksi -->
            <div class="flex items-center gap-3 pt-2">
                <button type="submit" class="bg-accentGreen hover:bg-green-400 text-slate-950 font-bold text-xs px-5 py-2.5 rounded-md transition shadow-md">
                    Simpan Jurnal
                </button>
                <a href="{{ route('jurnals.index') }}" class="bg-appBg border border-borderSubtle text-gray-300 hover:text-white text-xs px-4 py-2.5 rounded-md transition">
                    Kembali
                </a>
            </div>
        </form>
    </div>
</div>
@endsection