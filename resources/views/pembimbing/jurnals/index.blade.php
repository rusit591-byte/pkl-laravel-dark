<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Monitoring & Penilaian Jurnal Peserta PKL') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-darkBase min-h-screen text-gray-200">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="bg-green-900/50 border border-green-500 text-green-300 px-4 py-3 rounded-lg text-sm">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Filter Berdasarkan Peserta -->
            <div class="bg-darkSurface border border-darkBorder p-4 rounded-lg shadow-sm">
                <form method="GET" action="{{ route('pembimbing.jurnals') }}" class="flex flex-wrap items-center gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label class="block text-xs font-medium text-gray-400 mb-1">Filter Siswa / Peserta</label>
                        <select name="user_id" class="w-full bg-darkBase border border-darkBorder rounded text-sm text-gray-200 p-2 focus:border-accentGreen">
                            <option value="">-- Semua Peserta --</option>
                            @foreach($pesertas as $peserta)
                                <option value="{{ $peserta->id }}" {{ request('user_id') == $peserta->id ? 'selected' : '' }}>
                                    {{ $peserta->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex items-end gap-2 mt-5">
                        <button type="submit" class="px-4 py-2 bg-accentGreen text-slate-950 text-xs font-bold rounded hover:bg-green-400 transition">
                            Filter
                        </button>
                        <a href="{{ route('pembimbing.jurnals') }}" class="px-4 py-2 bg-darkBase border border-darkBorder text-gray-300 text-xs rounded hover:bg-darkBorder transition">
                            Reset
                        </a>
                    </div>
                </form>
            </div>

            <!-- Tabel Daftar Jurnal Peserta -->
            <div class="bg-darkSurface border border-darkBorder overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-white mb-4">Daftar Jurnal Terhubung dengan Peserta</h3>

                @if($jurnals->isEmpty())
                    <p class="text-gray-400 text-sm">Belum ada catatan jurnal dari peserta yang sesuai.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-300 border-collapse">
                            <thead>
                                <tr class="border-b border-darkBorder text-gray-400">
                                    <th class="py-3 px-4">Tanggal</th>
                                    <th class="py-3 px-4">Nama Peserta</th>
                                    <th class="py-3 px-4">Kegiatan / Deskripsi</th>
                                    <th class="py-3 px-4">Status & Approval</th>
                                    <th class="py-3 px-4">Aksi Penilaian & Komentar</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-darkBorder">
                                @foreach($jurnals as $jurnal)
                                    <tr class="hover:bg-darkBorder/30 align-top">
                                        <td class="py-3 px-4 whitespace-nowrap">{{ $jurnal->tanggal }}</td>
                                        <td class="py-3 px-4 font-medium text-white">{{ $jurnal->user->name ?? 'Peserta' }}</td>
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-white">{{ $jurnal->judul }}</div>
                                            <div class="text-xs text-gray-400 mt-1">{{ $jurnal->deskripsi }}</div>
                                            <span class="inline-block mt-2 px-2 py-0.5 bg-darkBase border border-darkBorder rounded text-[10px] text-gray-300">
                                                Kategori: {{ $jurnal->kategori->nama ?? 'Umum' }}
                                            </span>
                                        </td>
                                        <td class="py-3 px-4 whitespace-nowrap">
                                            <!-- Badge Status -->
                                            <span class="inline-block mb-2 px-2.5 py-1 rounded text-xs font-semibold 
                                                {{ $jurnal->status == 'selesai' ? 'bg-green-900 text-green-300' : ($jurnal->status == 'revisi' ? 'bg-yellow-900 text-yellow-300' : 'bg-blue-900 text-blue-300') }}">
                                                {{ ucfirst($jurnal->status) }}
                                            </span>

                                            <!-- Form Ubah Status / Approve -->
                                            <form action="{{ route('pembimbing.status.update', $jurnal->id) }}" method="POST" class="space-y-1">
                                                @csrf
                                                @method('PATCH')
                                                <select name="status" onchange="this.form.submit()" class="text-xs bg-darkBase border border-darkBorder rounded p-1 text-gray-200 focus:border-accentGreen">
                                                    <option value="proses" {{ $jurnal->status == 'proses' ? 'selected' : '' }}>Proses</option>
                                                    <option value="selesai" {{ $jurnal->status == 'selesai' ? 'selected' : '' }}>Approve (Selesai)</option>
                                                    <option value="revisi" {{ $jurnal->status == 'revisi' ? 'selected' : '' }}>Minta Revisi</option>
                                                </select>
                                            </form>
                                        </td>
                                        <td class="py-3 px-4">
                                            <!-- Form Kirim Komentar Pembimbing -->
                                            <form action="{{ route('pembimbing.komentar', $jurnal->id) }}" method="POST" class="space-y-2">
                                                @csrf
                                                <textarea name="isi" rows="2" placeholder="Tulis catatan atau evaluasi..." class="w-full text-xs bg-darkBase border border-darkBorder rounded p-2 text-gray-200 focus:outline-none focus:border-accentGreen" required></textarea>
                                                <button type="submit" class="px-3 py-1 bg-accentGreen text-slate-950 text-xs font-bold rounded hover:bg-green-400 transition">
                                                    Kirim Komentar
                                                </button>
                                            </form>

                                            <!-- Daftar Komentar / Evaluasi Sebelumnya -->
                                            @if($jurnal->komentars && $jurnal->komentars->count() > 0)
                                                <div class="mt-3 pt-2 border-t border-darkBorder space-y-1">
                                                    <span class="text-xs font-semibold text-gray-400">Riwayat Catatan Pembimbing:</span>
                                                    @foreach($jurnal->komentars as $komentar)
                                                        <div class="text-xs bg-darkBase p-2 rounded border border-darkBorder/50 text-gray-300">
                                                            <p>{{ $komentar->isi }}</p>
                                                            <span class="text-[10px] text-gray-500">{{ $komentar->created_at->diffForHumans() }} oleh {{ $komentar->user->name ?? 'Pembimbing' }}</span>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Paginasi -->
                    <div class="mt-4">
                        {{ $jurnals->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>