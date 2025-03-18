<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\KelolaUserController;

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [DashboardController::class, 'index'])->name('superadmin.dashboard');
    Route::resource('/superadmin/kelola-user', KelolaUserController::class)->names([
        'index'   => 'superadmin.kelola-user.index',
        'create'  => 'superadmin.kelola-user.create',
        'store'   => 'superadmin.kelola-user.store',
        'edit'    => 'superadmin.kelola-user.edit',
        'update'  => 'superadmin.kelola-user.update',
        'destroy' => 'superadmin.kelola-user.destroy',
    ]);
});
