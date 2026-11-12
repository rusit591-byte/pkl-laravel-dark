@extends('layouts.app')

@section('title', 'Monitoring Jurnal Peserta PKL')

@section('content')
<div class="space-y-5">
    
    <!-- Header Halaman -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-lg font-bold text-white">Monitoring Jurnal Peserta PKL</h1>
            <p class="text-xs text-gray-400 mt-0.5">Kelola penilaian, berikan komentar, dan pantau aktivitas harian siswa magang.</p>
        </div>
    </div>

    <!-- Notifikasi Sukses -->
    @if(session('success'))
        <div class="bg-emerald-950/60 border border-emerald-500/50 text-emerald-300 px-4 py-3 rounded-lg text-xs">
            {{ session('success') }}
        </div>
    @endif

    <!-- Form Filter Berdasarkan Peserta -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-4">
        <form method="GET" action="{{ route('pembimbing.jurnals') }}" class="flex flex-wrap items-center gap-3">
            <div class="flex-1 min-w-[240px]">
                <label class="block text-xs font-medium text-gray-400 mb-1">Filter Berdasarkan Siswa</label>
                <select name="user_id" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen">
                    <option value="">-- Semua Peserta Magang --</option>
                    @foreach($pesertas as $peserta)
                        <option value="{{ $peserta->id }}" {{ request('user_id') == $peserta->id ? 'selected' : '' }}>
                            {{ $peserta->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="flex items-end gap-2 mt-5 sm:mt-0">
                <button type="submit" class="bg-emerald-950 border border-emerald-900 text-accentGreen hover:bg-emerald-900 text-xs font-semibold px-4 py-2 rounded-md transition">
                    Terapkan Filter
                </button>
                <a href="{{ route('pembimbing.jurnals') }}" class="px-3 py-2 bg-appBg border border-borderSubtle text-gray-400 hover:text-white text-xs rounded-md transition" title="Reset Filter">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Daftar Jurnal Peserta -->
    <div class="space-y-3">
        @forelse($jurnals as $jurnal)
            <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5 flex flex-col justify-between gap-4">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                    <div class="space-y-1.5">
                        <div class="flex items-center gap-2 flex-wrap">
                            <!-- Badge Status -->
                            <span class="text-[10px] font-bold px-2.5 py-1 rounded {{ strtolower($jurnal->status) == 'selesai' ? 'bg-emerald-950 text-accentGreen border border-emerald-900' : (strtolower($jurnal->status) == 'proses' ? 'bg-amber-950 text-amber-400 border border-amber-900' : 'bg-red-950 text-red-400 border border-red-900') }}">
                                {{ ucfirst($jurnal->status) }}
                            </span>
                            
                            <!-- Badge Kategori -->
                            @if($jurnal->kategori)
                                <span class="text-[10px] bg-appBg border border-borderSubtle text-gray-300 px-2 py-0.5 rounded">
                                    {{ $jurnal->kategori->nama }}
                                </span>
                            @endif

                            <span class="text-xs text-gray-500">{{ $jurnal->tanggal }}</span>

                            <!-- Nama Peserta -->
                            @if(isset($jurnal->user))
                                <span class="text-[10px] bg-blue-950 text-blue-400 border border-blue-900 px-2 py-0.5 rounded font-medium">
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

                    <!-- Form Ubah Status / Approval Langsung oleh Pembimbing -->
                    <div class="self-end md:self-center bg-appBg border border-borderSubtle p-3 rounded-lg">
                        <label class="block text-[10px] font-semibold text-gray-400 mb-1">Ubah Status / Approval:</label>
                        <form action="{{ route('pembimbing.status.update', $jurnal->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <select name="status" onchange="this.form.submit()" class="text-xs bg-cardSurface border border-borderSubtle rounded px-2.5 py-1.5 text-gray-200 focus:border-accentGreen focus:outline-none cursor-pointer">
                                <option value="proses" {{ strtolower($jurnal->status) == 'proses' ? 'selected' : '' }}>Proses</option>
                                <option value="selesai" {{ strtolower($jurnal->status) == 'selesai' ? 'selected' : '' }}>Approve (Selesai)</option>
                                <option value="revisi" {{ strtolower($jurnal->status) == 'revisi' ? 'selected' : '' }}>Minta Revisi</option>
                            </select>
                        </form>
                    </div>
                </div>

                <!-- Bagian Komentar / Catatan Pembimbing -->
                <div class="mt-2 pt-3 border-t border-borderSubtle space-y-2">
                    <h3 class="text-xs font-semibold text-gray-400">Riwayat Catatan / Komentar Pembimbing:</h3>
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

                    <!-- Form Input Komentar Pembimbing -->
                    <form action="{{ route('pembimbing.komentar', $jurnal->id) }}" method="POST" class="mt-2 flex gap-2">
                        @csrf
                        <input type="text" name="isi" placeholder="Tulis catatan atau evaluasi untuk siswa..." class="flex-1 bg-appBg border border-borderSubtle rounded px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required>
                        <button type="submit" class="bg-accentGreen hover:bg-green-400 text-slate-950 font-bold px-4 py-2 rounded text-xs transition shadow-sm">
                            Kirim Komentar
                        </button>
                    </form>
                </div>

            </div>
        @empty
            <div class="bg-cardSurface border border-borderSubtle rounded-lg p-8 text-center text-gray-500 text-xs">
                Belum ada catatan jurnal harian dari peserta magang yang ditemukan.
            </div>
        @endforelse
    </div>

    <!-- Pagination links -->
    <div class="pt-2">
        {{ $jurnals->links() }}
    </div>

</div>
@endsection