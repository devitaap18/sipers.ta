<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BPO\DashboardController;
use App\Http\Controllers\BPO\KategoriAsetController;
use App\Http\Controllers\BPO\AsetController;
use App\Http\Controllers\BPO\PengajuanController;

Route::middleware(['auth', 'role:bpo'])->group(function () {
    Route::get('/bpo/dashboard', [DashboardController::class, 'index'])->name('bpo.dashboard');
    Route::resource('/bpo/kelola_aset', KategoriAsetController::class);
    Route::get('/bpo/kelola_aset', [AsetController::class, 'index'])->name('kelola_aset.index');
    Route::post('/bpo/kelola_aset/store', [AsetController::class, 'store'])->name('kelola_aset.store');
    Route::delete('/bpo/kelola_aset/{id}', [AsetController::class, 'destroy'])->name('kelola_aset.destroy');
    Route::get('/bpo/pengajuan', [PengajuanController::class, 'index'])->name('bpo.pengajuan.index');
    Route::post('/bpo/pengajuan/{id}/update-status', [PengajuanController::class, 'updateStatus'])->name('bpo.pengajuan.update-status');
});
