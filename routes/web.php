<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\GestationRecordController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\FeedingRecordController;

// Aplicar el grupo 'web' explícitamente
Route::middleware(['web'])->group(function () {

    // Rutas públicas
    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login']);
        Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register']);
    });

    // Rutas protegidas (Requieren Login Web)
    Route::middleware(['auth'])->group(function () {
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        
        Route::get('/', fn() => redirect()->route('dashboard'));
        Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

        Route::resource('farms', FarmController::class);
        Route::resource('animals', AnimalController::class);
        Route::resource('products', ProductController::class);
        Route::resource('recipes', RecipeController::class);
        Route::resource('gestations', GestationRecordController::class);
        Route::resource('treatments', TreatmentController::class);
        Route::resource('feedings', FeedingRecordController::class);
    });

});