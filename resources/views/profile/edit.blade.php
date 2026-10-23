@extends('layouts.app')

@section('title', 'Profil Saya - PKL Laravel')

@section('content')
<div class="max-w-2xl mx-auto space-y-5">
    
    <!-- Header Halaman -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-5">
        <h1 class="text-lg font-bold text-white">Profil Pengguna</h1>
        <p class="text-xs text-gray-400 mt-0.5">Kelola informasi akun dan pembaruan kata sandi Anda.</p>
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

    <!-- Card Edit Informasi Profil -->
    <div class="bg-cardSurface border border-borderSubtle rounded-lg p-6">
        <h2 class="text-sm font-semibold text-white mb-4">Informasi Akun</h2>
        
        <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
            @csrf
            @method('patch')

            <div>
                <label for="name" class="block text-xs font-semibold text-gray-300 mb-1">Nama Lengkap</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required autofocus autocomplete="name" />
                @if($errors->updateProfileInformation && $errors->updateProfileInformation->has('name'))
                    <p class="text-red-400 text-[11px] mt-1">{{ $errors->updateProfileInformation->first('name') }}</p>
                @endif
            </div>

            <div>
                <label for="email" class="block text-xs font-semibold text-gray-300 mb-1">Alamat Email</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" required autocomplete="username" />
                @if($errors->updateProfileInformation && $errors->updateProfileInformation->has('email'))
                    <p class="text-red-400 text-[11px] mt-1">{{ $errors->updateProfileInformation->first('email') }}</p>
                @endif
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
                <input id="current_password" name="current_password" type="password" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" autocomplete="current-password" />
                @if($errors->updatePassword && $errors->updatePassword->has('current_password'))
                    <p class="text-red-400 text-[11px] mt-1">{{ $errors->updatePassword->first('current_password') }}</p>
                @endif
            </div>

            <div>
                <label for="password" class="block text-xs font-semibold text-gray-300 mb-1">Kata Sandi Baru</label>
                <input id="password" name="password" type="password" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" autocomplete="new-password" />
                @if($errors->updatePassword && $errors->updatePassword->has('password'))
                    <p class="text-red-400 text-[11px] mt-1">{{ $errors->updatePassword->first('password') }}</p>
                @endif
            </div>

            <div>
                <label for="password_confirmation" class="block text-xs font-semibold text-gray-300 mb-1">Konfirmasi Kata Sandi Baru</label>
                <input id="password_confirmation" name="password_confirmation" type="password" class="w-full bg-appBg border border-borderSubtle rounded-md px-3 py-2 text-xs text-white focus:outline-none focus:border-accentGreen" autocomplete="new-password" />
            </div>

            <div class="pt-2">
                <button type="submit" class="bg-accentGreen hover:bg-green-400 text-slate-950 font-bold text-xs px-5 py-2.5 rounded-md transition shadow-md">
                    Ubah Kata Sandi
                </button>
            </div>
        </form>
    </div>

</div>
@endsection