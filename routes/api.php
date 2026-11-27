<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JurnalController;
use App\Http\Controllers\Api\PembimbingController;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('jurnals', JurnalController::class);

    Route::prefix('pembimbing')->group(function () {
        Route::get('/jurnals', [PembimbingController::class, 'index']);
        Route::patch('/jurnals/{id}/status', [PembimbingController::class, 'updateStatus']);
        Route::post('/jurnals/{id}/komentar', [PembimbingController::class, 'storeKomentar']);
    });
});