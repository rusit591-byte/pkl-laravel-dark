<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\JurnalController;

// Halaman Publik / Statis Minggu I
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Tambahkan Route Dashboard ini agar mengarah ke beranda atau daftar jurnal
Route::get('/dashboard', function () {
    return redirect()->route('jurnals.index'); // Atau redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

// Route CRUD Jurnal Harian (Dilindungi Middleware Auth)
Route::middleware(['auth'])->group(function () {
    Route::resource('jurnals', JurnalController::class);
});

// Route bawaan Breeze untuk Auth (Login, Register, Profile)
require __DIR__.'/auth.php';