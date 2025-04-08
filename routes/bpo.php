<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BPO\DashboardController;
use App\Http\Controllers\BPO\KategoriAsetController;
use App\Http\Controllers\BPO\AsetController;
use App\Http\Controllers\BPO\PengajuanController;

Route::middleware(['auth', 'role:bpo'])->prefix('bpo')->name('bpo.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Kategori Aset
    Route::resource('/kelola_kategori', KategoriAsetController::class)->except(['show']);
    Route::post('/kelola_kategori/update/{id}', [KategoriAsetController::class, 'update'])->name('kelola_kategori.update');

    // Aset
    Route::get('/kelola_aset', [AsetController::class, 'index'])->name('kelola_aset.index');
    Route::post('/kelola_aset/store', [AsetController::class, 'store'])->name('kelola_aset.store');
    Route::post('/kelola_aset/update/{id}', [AsetController::class, 'update'])->name('kelola_aset.update');
    Route::delete('/kelola_aset/{id}', [AsetController::class, 'destroy'])->name('kelola_aset.destroy');

    // Pengajuan
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
    Route::post('/pengajuan/{id}/update-status', [PengajuanController::class, 'updateStatus'])->name('pengajuan.update-status');
});