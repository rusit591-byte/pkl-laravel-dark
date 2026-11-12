<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;

// Halaman Publik / Statis
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');

// Route yang membutuhkan autentikasi (Login)
Route::middleware(['auth'])->group(function () {
    
    // Dashboard Ringkasan (Agregasi Data)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Jurnal Harian (Peserta)
    Route::resource('jurnals', JurnalController::class);

    // Export PDF
    Route::get('/jurnals/export-pdf', [ExportController::class, 'exportPdf'])->name('jurnals.export-pdf');

    // Manajemen Profil (Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Khusus Pembimbing (Dilindungi Middleware Role)
Route::middleware(['auth', 'role:pembimbing'])->prefix('pembimbing')->name('pembimbing.')->group(function () {
    Route::get('/jurnals', [PembimbingController::class, 'index'])->name('jurnals');
    Route::post('/jurnals/{jurnal}/komentar', [PembimbingController::class, 'storeKomentar'])->name('komentar');
    Route::patch('/jurnals/{jurnal}/status', [PembimbingController::class, 'updateStatus'])->name('status.update');
});

// MEMUAT RUTE AUTENTIKASI
require __DIR__.'/auth.php';