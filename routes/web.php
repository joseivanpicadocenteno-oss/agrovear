<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\GestationRecordController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\FeedingRecordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Autenticación Web (Vistas + Procesamiento)
Route::middleware('guest')->group(function () {
    Route::get('/login', fn() => view('auth.login'))->name('login');
    Route::get('/register', fn() => view('auth.register'))->name('register');
});

// Panel Principal y Módulos Protegidos por Sesión
Route::middleware(['auth'])->group(function () {
    Route::get('/', fn() => redirect()->route('dashboard'));
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    // Recursos Web (CRUDs completos con Blade)
    Route::resource('farms', FarmController::class);
    Route::resource('animals', AnimalController::class);
    Route::resource('products', ProductController::class);
    Route::resource('recipes', RecipeController::class);
    Route::resource('gestations', GestationRecordController::class);
    Route::resource('treatments', TreatmentController::class);
    Route::resource('feedings', FeedingRecordController::class);
});