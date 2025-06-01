<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ErrorController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::middleware("auth")->group(function () {
    Route::get('/home', [DashboardController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::prefix('usuarios')->middleware('auth', 'checkrole:admin')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('usuarios');
    Route::post('/', [UserController::class, 'store'])->name('usuarios.store');    
    Route::post('/{id}/estado', [UserController::class, 'estado'])->name('usuarios.estado');
    Route::get('/create', [UserController::class, 'create'])->name('usuarios.create');
    Route::get('{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
    Route::put('/{usuario}', [UserController::class, 'update'])->name('usuarios.update');
    Route::delete('/{usuario}', [UserController::class, 'destroy'])->name('usuarios.destroy');
});
