@extends('layouts.app')

@section('title', 'Profil Saya - PKL Laravel')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">
    
    <!-- Header Halaman -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5">
        <h1 class="text-lg font-bold text-white">Profil Pengguna</h1>
        <p class="text-xs text-gray-400 mt-0.5">Kelola informasi akun, foto profil, dan keamanan Anda.</p>
    </div>

    @if (session('status') === 'profile-updated')
        <div class="bg-emerald-950/80 border border-emerald-900 text-accentGreen text-xs p-3 rounded-lg">
            Informasi profil berhasil diperbarui.
        </div>
    @endif

    @if (session('status') === 'password-updated')
        <div class="bg-emerald-950/80 border border-emerald-900 text-accentGreen text-xs p-3 rounded-lg">
            Kata sandi berhasil diperbarui.
        </div>
    @endif

    <!-- Card Edit Informasi & Foto Profil -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-6">
        <h2 class="text-sm font-semibold text-white mb-4">Informasi Akun & Foto</h2>
        
        <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('patch')

            <!-- Preview & Upload Foto -->
            <div class="flex items-center gap-4 pb-2">
                <div class="w-14 h-14 rounded-full bg-emerald-950 border border-emerald-900 text-accentGreen flex items-center justify-center text-lg font-bold overflow-hidden">
                    @if(Auth::user()->avatar)
                        <img src="{{ asset('storage/' . Auth::user()->avatar) }}" alt="Avatar" class="w-full h-full object-cover">
                    @else
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    @endif
                </div>
                <div>
                    <label class="block text-xs font-semibold text-gray-300 mb-1">Ganti Foto Profil</label>
                    <input type="file" name="avatar" class="text-xs text-gray-400 file:mr-3 file:py-1.5 file:px-3 file:rounded-md file:border-0 file:text-xs file:font-semibold file:bg-appBg file:text-accentGreen hover:file:bg-emerald-950 file:border-borderSubtle file:border cursor-pointer">
                </div>
            </div>

            <div>
                <label for="name" class="block text-xs font-semibold text-gray-300 mb-1">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required />
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold text-gray-300 mb-1">Alamat Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required />
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-accentGreen hover:bg-green-400 text-slate-950 font-bold text-xs px-5 py-2.5 rounded-md transition shadow-md">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>

    <!-- Card Ubah Password -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-6">
        <h2 class="text-sm font-semibold text-white mb-4">Perbarui Kata Sandi</h2>

        <form method="post" action="{{ route('password.update') }}" class="space-y-4">
            @csrf
            @method('put')

            <div>
                <label for="current_password" class="block text-xs font-semibold text-gray-300 mb-1">Kata Sandi Saat Ini</label>
                <input id="current_password" name="current_password" type="password" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" />
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-gray-300 mb-1">Kata Sandi Baru</label>
                <input id="password" name="password" type="password" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" />
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-gray-300 mb-1">Konfirmasi Kata Sandi Baru</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" />
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-accentGreen hover:bg-green-400 text-slate-950 font-bold text-xs px-5 py-2.5 rounded-md transition shadow-md">
                    Ubah Kata Sandi
                </button>
            </div>
        </form>
    </div>

    <!-- Card Hapus Akun -->
    <div class="bg-cardSurface border border-red-900/50 rounded-lg p-6">
        <h2 class="text-sm font-semibold text-red-400 mb-1">Hapus Akun</h2>
        <p class="text-xs text-gray-400 mb-4">Setelah akun dihapus, seluruh data dan catatan jurnal harian Anda akan hilang secara permanen.</p>

        <form method="post" action="{{ route('profile.destroy') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini secara permanen?')">
            @csrf
            @method('delete')

            <div>
                <label for="password_del" class="block text-xs font-semibold text-gray-300 mb-1">Masukkan Password untuk Konfirmasi</label>
                <input id="password_del" name="password" type="password" placeholder="Password Anda" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-red-500 mb-3" required />
            </div>

            <button type="submit" class="bg-red-950/60 border border-red-900 text-red-400 hover:bg-red-900/60 text-xs font-bold px-4 py-2 rounded-md transition">
                Hapus Akun Permanen
            </button>
        </form>
    </div>

</div>
@endsection