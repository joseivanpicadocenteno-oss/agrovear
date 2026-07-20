<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\FarmController;
use App\Http\Controllers\FeedingRecordController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('animals', AnimalController::class);

Route::apiResource('products', ProductController::class);

Route::apiResource('recipes', RecipeController::class);

Route::apiResource('farms', FarmController::class);

Route::apiResource('feeding_records', FeedingRecordController::class);