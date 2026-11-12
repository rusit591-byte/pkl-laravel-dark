<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;

// Halaman Utama langsung diarahkan ke Dashboard jika login, atau ke Login jika belum
Route::get('/', [DashboardController::class, 'index'])->middleware(['auth'])->name('home');
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth'])->name('dashboard');

// Halaman Statis Pendukung
Route::get('/about', [App\Http\Controllers\PageController::class, 'about'])->name('about');
Route::get('/contact', [App\Http\Controllers\PageController::class, 'contact'])->name('contact');

// Route yang membutuhkan autentikasi (Peserta / Umum)
Route::middleware(['auth'])->group(function () {
    // CRUD Jurnal Harian
    Route::resource('jurnals', JurnalController::class);

    // Export PDF
    Route::get('/jurnals/export-pdf', [ExportController::class, 'exportPdf'])->name('jurnals.export-pdf');

    // Manajemen Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route Khusus Pembimbing
Route::middleware(['auth', 'role:pembimbing'])->prefix('pembimbing')->name('pembimbing.')->group(function () {
    Route::get('/jurnals', [PembimbingController::class, 'index'])->name('jurnals');
    Route::post('/jurnals/{jurnal}/komentar', [PembimbingController::class, 'storeKomentar'])->name('komentar');
    Route::patch('/jurnals/{jurnal}/status', [PembimbingController::class, 'updateStatus'])->name('status.update');
});

require __DIR__.'/auth.php';