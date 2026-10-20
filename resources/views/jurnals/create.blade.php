@extends('layouts.app')

@section('title', 'Tambah Jurnal - PKL Laravel')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">
    
    <!-- Header Form -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5">
        <h1 class="text-lg font-bold text-white">Tambah Jurnal Harian</h1>
        <p class="text-xs text-gray-400 mt-0.5">Catat aktivitas dan progres pekerjaan PKL baru Anda.</p>
    </div>

    <!-- Card Form -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-6">
        <form action="{{ route('jurnals.store') }}" method="POST" class="space-y-4">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Tanggal Kegiatan</label>
                <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Judul Kegiatan</label>
                <input type="text" name="judul" placeholder="Contoh: Implementasi Migrasi Database Laravel" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Deskripsi / Uraian Tugas</label>
                <textarea name="deskripsi" rows="4" placeholder="Tuliskan rincian kegiatan yang dikerjakan..." class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required></textarea>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Status Pekerjaan</label>
                <select name="status" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen">
                    <option value="todo">Todo</option>
                    <option value="proses" selected>Proses</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-300 mb-1">Kendala (Opsional)</label>
                <input type="text" name="kendala" placeholder="Tuliskan kendala jika ada..." class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen">
            </div>

            <div class="flex items-center gap-3 pt-3">
                <button type="submit" class="bg-accentGreen hover:bg-green-400 text-slate-950 font-bold text-xs px-5 py-2.5 rounded-md transition shadow-md">
                    Simpan Jurnal
                </button>
                <a href="{{ route('jurnals.index') }}" class="bg-appBg border border-borderSubtle text-gray-300 text-xs px-4 py-2.5 rounded-md hover:text-white transition">
                    Batal
                </a>
            </div>
        </form>
    </div>

</div>
@endsection