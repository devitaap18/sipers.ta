<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect('/login');
});

// Route login/logout
use App\Http\Controllers\AuthController;
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Load route berdasarkan role
require __DIR__ . '/admin.php';
require __DIR__ . '/vp.php';
require __DIR__ . '/bpo.php';
require __DIR__ . '/superadmin.php';