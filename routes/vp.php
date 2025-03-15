<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VP\DashboardController;
use App\Http\Controllers\VP\DaftarAjuanController;

Route::middleware(['auth', 'role:vp'])->group(function () {
    Route::get('/vp/dashboard', [DashboardController::class, 'index'])->name('vp.dashboard');
    Route::get('/vp/daftar_ajuan', [DaftarAjuanController::class, 'index'])->name('vp.daftar_ajuan');
    Route::post('/vp/daftar_ajuan/{id}/update-status', [DaftarAjuanController::class, 'updateStatus']);
});
