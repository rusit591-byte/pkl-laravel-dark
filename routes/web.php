<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\JurnalController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'landing'])->name('landing');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/jurnals/export-pdf', [ExportController::class, 'exportPdf'])->name('jurnals.export-pdf');
    Route::resource('jurnals', JurnalController::class);

    Route::prefix('pembimbing')->middleware('role:pembimbing')->name('pembimbing.')->group(function () {
        Route::get('/jurnals', [PembimbingController::class, 'index'])->name('jurnals');
        Route::post('/jurnals/{jurnal}/komentar', [PembimbingController::class, 'storeKomentar'])->name('komentar');
        Route::patch('/jurnals/{jurnal}/status', [PembimbingController::class, 'updateStatus'])->name('status.update');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';