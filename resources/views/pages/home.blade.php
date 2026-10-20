@extends('layouts.app')

@section('title', 'Beranda - Portal PKL')

@section('content')
<div class="space-y-4">
    <div class="bg-darkSurface border border-darkBorder rounded-xl p-6">
        <span class="text-[10px] uppercase font-semibold bg-emerald-950 text-accentGreen border border-emerald-900 px-2.5 py-0.5 rounded">Program PKL PT Metanouva</span>
        <h1 class="text-2xl font-bold text-white mt-2 mb-1">Sistem Jurnal Harian Laravel</h1>
        <p class="text-gray-400 text-xs leading-relaxed max-w-xl">
            Platform web terstruktur untuk memantau progress kegiatan harian, manajemen autentikasi, serta implementasi CRUD berbasis arsitektur MVC.
        </p>
    </div>

    <div class="bg-darkSurface border border-darkBorder rounded-xl divide-y divide-darkBorder">
        <div class="p-4 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-white">Kelola Jurnal Harian</h3>
                <p class="text-xs text-gray-400">Tambah, ubah, dan pantau status progres tugas harian.</p>
            </div>
            <a href="{{ route('jurnals.index') }}" class="text-xs bg-accentGreen text-slate-950 font-bold px-3.5 py-1.5 rounded hover:bg-green-400 transition">Buka Menu</a>
        </div>
        <div class="p-4 flex items-center justify-between">
            <div>
                <h3 class="text-sm font-semibold text-white">Profil Pengguna</h3>
                <p class="text-xs text-gray-400">Atur informasi akun dan data profil tambahan.</p>
            </div>
            <a href="{{ route('profile.edit') }}" class="text-xs bg-darkBase border border-darkBorder text-gray-300 px-3.5 py-1.5 rounded hover:text-white transition">Pengaturan</a>
        </div>
    </div>
</div>
@endsection