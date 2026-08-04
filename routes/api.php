<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FeedingRecordController;
use App\Http\Controllers\GestationRecordController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\TreatmentDetailController;
use App\Http\Controllers\RecipeDetailController;

// Rutas públicas
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

// Rutas protegidas
Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', [AuthController::class, 'user']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('animals', AnimalController::class);
    Route::apiResource('products', ProductController::class);
    Route::apiResource('recipes', RecipeController::class);
    Route::apiResource('farms', FarmController::class);
    Route::apiResource('feeding_records', FeedingRecordController::class);
    Route::apiResource('gestation_records', GestationRecordController::class);
    Route::apiResource('treatments', TreatmentController::class);
    Route::apiResource('treatment_details', TreatmentDetailController::class);
    Route::apiResource('recipe_details', RecipeDetailController::class);

});