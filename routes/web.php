<?php

use Illuminate\Support\Facades\Route;

// Autenticación
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

// Controladores principales
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\GestationRecordController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\FeedingRecordController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\RecipeDetailController;

/*
 Rutas públicas
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [LoginController::class, 'showLoginForm'])
        ->name('login');

    Route::post('/login', [LoginController::class, 'login'])
        ->name('login.submit');

    // Registro
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])
        ->name('register');

    Route::post('/register', [RegisterController::class, 'register'])
        ->name('register.submit');
});

/*
Rutas protegidas
*/

Route::middleware('auth')->group(function () {

    // Cerrar sesión
    Route::post('/logout', [LoginController::class, 'logout'])
        ->name('logout');

    // Inicio
    Route::get('/', function () {
        return redirect()->route('dashboard');
    });

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    /*
    Módulos principales
    */

    Route::resource('farms', FarmController::class);

    Route::resource('animals', AnimalController::class);

    Route::resource('products', ProductController::class);

    Route::resource('recipes', RecipeController::class);

    Route::resource('gestations', GestationRecordController::class);

    Route::resource('treatments', TreatmentController::class);

    Route::resource('feedings', FeedingRecordController::class);

    Route::resource('alerts', AlertController::class);
    
    Route::resource('recipe-details', RecipeDetailController::class)
    ->middleware('auth');
});
