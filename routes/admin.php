<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PengajuanController;

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/pengajuan', [PengajuanController::class, 'index'])->name('admin.pengajuan.index');
    Route::get('/admin/pengajuan/create', [PengajuanController::class, 'create'])->name('admin.pengajuan.create');
    Route::post('/admin/pengajuan/store', [PengajuanController::class, 'store'])->name('admin.pengajuan.store');
    Route::get('/admin/pengajuan/{id}', [PengajuanController::class, 'show']);
});
