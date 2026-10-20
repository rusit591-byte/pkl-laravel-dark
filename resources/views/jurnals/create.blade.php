@extends('layouts.app')

@section('title', 'Tambah Jurnal')
@section('header_title', 'Tambah Jurnal Baru')

@section('content')
<div class="max-w-xl mx-auto bg-darkSurface border border-darkBorder rounded-lg p-6">
    <form action="{{ route('jurnals.store') }}" method="POST" class="space-y-4">
        @csrf
        <div>
            <label class="block text-xs font-semibold text-gray-300 mb-1">Tanggal</label>
            <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" class="w-full bg-darkBase border border-darkBorder rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-accentGreen" required>
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-300 mb-1">Judul Kegiatan</label>
            <input type="text" name="judul" class="w-full bg-darkBase border border-darkBorder rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-accentGreen" placeholder="Contoh: Belajar Routing Laravel" required>
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-300 mb-1">Deskripsi / Uraian</label>
            <textarea name="deskripsi" rows="3" class="w-full bg-darkBase border border-darkBorder rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-accentGreen" placeholder="Jelaskan apa yang dipelajari..." required></textarea>
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-300 mb-1">Status Pekerjaan</label>
            <select name="status" class="w-full bg-darkBase border border-darkBorder rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-accentGreen">
                <option value="todo">Todo</option>
                <option value="proses">Proses</option>
                <option value="selesai">Selesai</option>
            </select>
        </div>
        <div>
            <label class="block text-xs font-semibold text-gray-300 mb-1">Kendala (Opsional)</label>
            <input type="text" name="kendala" class="w-full bg-darkBase border border-darkBorder rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-accentGreen" placeholder="Kendala jika ada...">
        </div>
        <div class="flex gap-3 pt-2">
            <button type="submit" class="flex-1 bg-accentGreen hover:bg-green-400 text-slate-950 font-bold py-2 rounded text-sm transition">Simpan Jurnal</button>
            <a href="{{ route('jurnals.index') }}" class="px-4 py-2 bg-darkBase border border-darkBorder text-gray-300 text-sm rounded text-center hover:text-white">Batal</a>
        </div>
    </form>
</div>
@endsection