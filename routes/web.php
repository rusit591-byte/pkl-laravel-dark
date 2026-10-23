<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\ProfileController; // <-- TAMBAHKAN INI DI BAGIAN ATAS

// Halaman Publik / Statis Minggu I
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Route Dashboard Alias
Route::get('/dashboard', function () {
    return redirect()->route('jurnals.index');
})->middleware(['auth'])->name('dashboard');

// Route CRUD Jurnal Harian (Dilindungi Middleware Auth)
Route::middleware(['auth'])->group(function () {
    Route::resource('jurnals', JurnalController::class);
});

// --- TAMBAHKAN GROUP ROUTE PROFILE INI ---
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// MEMUAT RUTE AUTENTIKASI BROWSER (LOGIN, REGISTER, PROFILE)
require __DIR__.'/auth.php';