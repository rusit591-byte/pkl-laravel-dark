@extends('layouts.app')

@section('title', 'Kontak - PKL Laravel')

@section('content')
<div class="max-w-2xl mx-auto bg-cardBg rounded-xl p-8 border border-gray-700 shadow-xl">
    <h2 class="text-2xl font-bold text-accentColor mb-2">Hubungi Pembimbing PKL</h2>
    <p class="text-gray-400 mb-6">Kirimkan pertanyaan atau kendala teknis seputar proyek Laravel Anda.</p>

    <form class="space-y-4" onsubmit="event.preventDefault(); alert('Pesan tersimulasi dikirim!');">
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Nama Lengkap</label>
            <input type="text" class="w-full bg-slate-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-accentColor" placeholder="Nama Peserta PKL" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Email</label>
            <input type="email" class="w-full bg-slate-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-accentColor" placeholder="email@metanouva.com" required>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-300 mb-1">Pesan / Kendala Teknis</label>
            <textarea rows="4" class="w-full bg-slate-900 border border-gray-700 rounded-lg px-4 py-2 text-white focus:outline-none focus:border-accentColor" placeholder="Tuliskan kendala Anda..." required></textarea>
        </div>
        <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-slate-900 font-bold py-2.5 rounded-lg transition shadow-md">
            Kirim Pesan
        </button>
    </form>
</div>
@endsection