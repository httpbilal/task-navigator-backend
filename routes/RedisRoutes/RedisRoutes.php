<?php

use App\Http\Controllers\RedisController\RedisController;
use Illuminate\Support\Facades\Route;


// Public routes

// Route::middleware('auth:api')->group(function () {
    Route::get('fetch-top-tasks/{userId}', [RedisController::class, 'fetchTopPriorityTasks']);
    Route::post('cache-top-tasks/{userId}', [RedisController::class, 'savePriorityTasks']);

// });