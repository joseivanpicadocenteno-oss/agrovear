<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlertController;

/*
API Routes
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/alerts', [AlertController::class, 'index']);

    Route::post('/alerts', [AlertController::class, 'store']);

    Route::get('/alerts/{alert}', [AlertController::class, 'show']);

    Route::patch('/alerts/{alert}/read', [AlertController::class, 'markAsRead']);

    Route::delete('/alerts/{alert}', [AlertController::class, 'destroy']);
});
