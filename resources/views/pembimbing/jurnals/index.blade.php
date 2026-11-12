<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Monitoring Jurnal Peserta PKL') }}
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

            <!-- Tabel Daftar Jurnal Peserta -->
            <div class="bg-darkSurface border border-darkBorder overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-white mb-4">Daftar Aktivitas Harian Peserta</h3>

                @if($jurnals->isEmpty())
                    <p class="text-gray-400 text-sm">Belum ada catatan jurnal dari peserta magang.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-gray-300 border-collapse">
                            <thead>
                                <tr class="border-b border-darkBorder text-gray-400">
                                    <th class="py-3 px-4">Tanggal</th>
                                    <th class="py-3 px-4">Nama Peserta</th>
                                    <th class="py-3 px-4">Judul / Kegiatan</th>
                                    <th class="py-3 px-4">Status</th>
                                    <th class="py-3 px-4">Aksi & Komentar</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-darkBorder">
                                @foreach($jurnals as $jurnal)
                                    <tr class="hover:bg-darkBorder/30">
                                        <td class="py-3 px-4 whitespace-nowrap">{{ $jurnal->tanggal }}</td>
                                        <td class="py-3 px-4 font-medium text-white">{{ $jurnal->user->name ?? 'Peserta' }}</td>
                                        <td class="py-3 px-4">
                                            <div class="font-semibold text-white">{{ $jurnal->judul }}</div>
                                            <div class="text-xs text-gray-400 truncate max-w-xs">{{ $jurnal->deskripsi }}</div>
                                        </td>
                                        <td class="py-3 px-4 whitespace-nowrap">
                                            <span class="px-2.5 py-1 rounded text-xs font-semibold 
                                                {{ $jurnal->status == 'selesai' ? 'bg-green-900 text-green-300' : ($jurnal->status == 'revisi' ? 'bg-yellow-900 text-yellow-300' : 'bg-blue-900 text-blue-300') }}">
                                                {{ ucfirst($jurnal->status) }}
                                            </span>
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

                                            <!-- Daftar Komentar Sebelumnya -->
                                            @if($jurnal->komentars && $jurnal->komentars->count() > 0)
                                                <div class="mt-3 pt-2 border-t border-darkBorder space-y-1">
                                                    <span class="text-xs font-semibold text-gray-400">Catatan Pembimbing:</span>
                                                    @foreach($jurnal->komentars as $komentar)
                                                        <div class="text-xs bg-darkBase p-2 rounded border border-darkBorder/50 text-gray-300">
                                                            <p>{{ $komentar->isi }}</p>
                                                            <span class="text-[10px] text-gray-500">{{ $komentar->created_at->diffForHumans() }}</span>
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