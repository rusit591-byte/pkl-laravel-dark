@extends('layouts.app')

@section('title', 'Jurnal Harian - Portal PKL')

@section('content')
<div class="space-y-5">
    
    <!-- Header & Tombol Tambah -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-lg font-bold text-white">Jurnal Harian PKL</h1>
            <p class="text-xs text-gray-400 mt-0.5">Catatan rekapitulasi progres pekerjaan harian Anda.</p>
        </div>
        <a href="{{ route('jurnals.create') }}" class="bg-accentGreen hover:bg-green-400 text-slate-950 font-bold text-xs px-4 py-2 rounded-md transition shadow-sm flex items-center gap-1.5">
            + Tambah Jurnal
        </a>
    </div>

    <!-- Form Pencarian dan Filter Kategori/Status/Tanggal -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-4">
        <form method="GET" action="{{ route('jurnals.index') }}" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-5 gap-3">
            
            <!-- Cari Judul -->
            <div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..." class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen">
            </div>

            <!-- Filter Kategori -->
            <div>
                <select name="kategori_id" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen">
                    <option value="">Semua Kategori</option>
                    @foreach($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori_id') == $kat->id ? 'selected' : '' }}>{{ $kat->nama }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Filter Status -->
            <div>
                <select name="status" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen">
                    <option value="">Semua Status</option>
                    <option value="Proses" {{ request('status') == 'Proses' ? 'selected' : '' }}>Proses</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                    <option value="Revisi" {{ request('status') == 'Revisi' ? 'selected' : '' }}>Revisi</option>
                </select>
            </div>

            <!-- Filter Tanggal -->
            <div>
                <input type="date" name="tanggal" value="{{ request('tanggal') }}" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen">
            </div>

            <!-- Tombol Filter & Reset -->
            <div class="flex items-center gap-2">
                <button type="submit" class="flex-1 bg-emerald-950 border border-emerald-900 text-accentGreen hover:bg-emerald-900 text-xs font-semibold py-2 rounded-md transition">
                    Filter
                </button>
                <a href="{{ route('jurnals.index') }}" class="px-3 py-2 bg-appBg border border-borderSubtle text-gray-400 hover:text-white text-xs rounded-md transition" title="Reset Filter">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Daftar Jurnal -->
    <div class="space-y-3">
        @forelse($jurnals as $jurnal)
            <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5 flex flex-col justify-between gap-4">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="space-y-1.5">
                        <div class="flex items-center gap-2 flex-wrap">
                            <span class="text-[10px] font-bold px-2 py-0.5 rounded {{ $jurnal->status == 'Selesai' ? 'bg-emerald-950 text-accentGreen border border-emerald-900' : ($jurnal->status == 'Proses' ? 'bg-amber-950 text-amber-400 border border-amber-900' : 'bg-red-950 text-red-400 border border-red-900') }}">
                                {{ $jurnal->status }}
                            </span>
                            
                            <!-- Badge Kategori -->
                            @if($jurnal->kategori)
                                <span class="text-[10px] bg-appBg border border-borderSubtle text-gray-300 px-2 py-0.5 rounded">
                                    {{ $jurnal->kategori->nama }}
                                </span>
                            @endif

                            <span class="text-xs text-gray-500">{{ $jurnal->tanggal }}</span>

                            <!-- Menampilkan nama peserta jika dilihat oleh pembimbing -->
                            @if(auth()->user()->role === 'pembimbing' && isset($jurnal->user))
                                <span class="text-[10px] bg-blue-950 text-blue-400 border border-blue-900 px-2 py-0.5 rounded">
                                    👤 Peserta: {{ $jurnal->user->name }}
                                </span>
                            @endif
                        </div>

                        <h2 class="text-sm font-bold text-white">{{ $jurnal->judul }}</h2>
                        <p class="text-xs text-gray-300 leading-relaxed">{{ $jurnal->deskripsi }}</p>

                        <!-- Lampiran Link -->
                        @if($jurnal->lampiran)
                            <div class="pt-1">
                                <a href="{{ asset('storage/' . $jurnal->lampiran) }}" target="_blank" class="text-[11px] text-accentGreen hover:underline inline-flex items-center gap-1">
                                    📎 Lihat Lampiran / Bukti
                                </a>
                            </div>
                        @endif
                    </div>

                    <!-- Tombol Aksi (Hanya muncul jika bukan pembimbing / milik sendiri) -->
                    @if(auth()->user()->role !== 'pembimbing')
                        <div class="flex items-center gap-2 self-end md:self-center">
                            <a href="{{ route('jurnals.edit', $jurnal->id) }}" class="text-xs bg-appBg border border-borderSubtle hover:border-accentGreen text-gray-300 px-3 py-1.5 rounded-md transition">
                                Ubah
                            </a>
                            <form action="{{ route('jurnals.destroy', $jurnal->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus jurnal ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs bg-red-950/40 border border-red-900 hover:bg-red-900/60 text-red-400 px-3 py-1.5 rounded-md transition">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @endif
                </div>

                <!-- Bagian Komentar / Catatan Pembimbing -->
                <div class="mt-2 pt-3 border-t border-borderSubtle space-y-2">
                    <h3 class="text-xs font-semibold text-gray-400">Catatan / Komentar Pembimbing:</h3>
                    @forelse($jurnal->komentars as $komentar)
                        <div class="bg-appBg border border-borderSubtle p-2.5 rounded text-xs space-y-1">
                            <div class="flex justify-between text-[10px] text-gray-500">
                                <span class="font-bold text-accentGreen">{{ $komentar->user->name ?? 'Pembimbing' }}</span>
                                <span>{{ $komentar->created_at->diffForHumans() }}</span>
                            </div>
                            <p class="text-gray-300">{{ $komentar->isi }}</p>
                        </div>
                    @empty
                        <p class="text-[11px] text-gray-500 italic">Belum ada catatan dari pembimbing.</p>
                    @endforelse

                    <!-- Form Input Komentar khusus Pembimbing -->
                    @if(auth()->user()->role === 'pembimbing')
                        <form action="{{ route('pembimbing.jurnals.komentar', $jurnal->id) }}" method="POST" class="mt-2 flex gap-2">
                            @csrf
                            <input type="text" name="isi" placeholder="Tulis catatan atau evaluasi..." class="flex-1 bg-appBg border border-borderSubtle rounded px-2 py-1.5 text-xs text-white focus:outline-none focus:border-accentGreen" required>
                            <button type="submit" class="bg-accentGreen hover:bg-green-400 text-slate-950 font-bold px-3 py-1.5 rounded text-xs transition">Kirim</button>
                        </form>
                    @endif
                </div>

            </div>
        @empty
            <div class="bg-cardSurface border border-borderSubtle rounded-lg p-8 text-center text-gray-500 text-xs">
                Belum ada catatan jurnal harian yang ditemukan.
            </div>
        @endforelse
    </div>

    <!-- Pagination links -->
    <div class="pt-2">
        {{ $jurnals->links() }}
    </div>

</div>
@endsection