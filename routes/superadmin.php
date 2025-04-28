<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Superadmin\DashboardController;
use App\Http\Controllers\Superadmin\RoleController;
use App\Http\Controllers\Superadmin\MenuController;

Route::middleware(['auth', 'role:superadmin'])->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('role', RoleController::class)->except(['create', 'edit', 'show']);
    Route::resource('menu', MenuController::class)->except(['create', 'edit', 'show']);
    Route::resource('user', \App\Http\Controllers\Superadmin\UserController::class);
});
