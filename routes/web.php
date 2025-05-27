<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorController;
use Illuminate\Support\Facades\Route;


// Redirección raíz
Route::redirect('/', '/login');

// Autenticación
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas
Route::middleware('auth')->group(function () {
    // Dashboard genérico
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    
    // Admin
    Route::middleware('role:admin')->prefix('admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');
    });

    // Commercial
    Route::middleware('role:commercial')->prefix('commercial')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'commercial'])->name('commercial.dashboard');
    });
});

// Manejo de errores
Route::controller(ErrorController::class)->group(function () {
    Route::get('/403', 'show403')->name('errors.403');
});
