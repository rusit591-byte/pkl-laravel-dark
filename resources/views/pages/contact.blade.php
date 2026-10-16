@extends('layouts.app')

@section('title', 'Kontak - PKL Laravel')

@section('content')
<div class="max-w-xl mx-auto bg-cardBg rounded-lg p-6 border border-gray-800">
    <h2 class="text-lg font-bold text-white mb-1">Hubungi Pembimbing PKL</h2>
    <p class="text-gray-400 text-xs mb-5">Kirimkan pertanyaan atau kendala teknis seputar proyek Laravel Anda.</p>

    <form class="space-y-4" onsubmit="event.preventDefault(); alert('Pesan tersimulasi dikirim!');">
        <div>
            <label class="block text-xs font-medium text-gray-300 mb-1">Nama Lengkap</label>
            <input type="text" class="w-full bg-darkBg border border-gray-800 rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-accentColor" placeholder="Nama Peserta PKL" required>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-300 mb-1">Email</label>
            <input type="email" class="w-full bg-darkBg border border-gray-800 rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-accentColor" placeholder="email@metanouva.com" required>
        </div>
        <div>
            <label class="block text-xs font-medium text-gray-300 mb-1">Pesan / Kendala Teknis</label>
            <textarea rows="3" class="w-full bg-darkBg border border-gray-800 rounded px-3 py-2 text-sm text-white focus:outline-none focus:border-accentColor" placeholder="Tuliskan kendala Anda..." required></textarea>
        </div>
        <button type="submit" class="w-full bg-accentColor hover:bg-green-400 text-slate-950 font-bold py-2 rounded text-sm transition">
            Kirim Pesan
        </button>
    </form>
</div>
@endsection