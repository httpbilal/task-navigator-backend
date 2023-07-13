<?php

use App\Http\Controllers\RedisTaskController\RedisTaskController;
use App\Http\Controllers\RedisUserController\RedisUserController;
use Illuminate\Support\Facades\Route;


// Public routes

Route::middleware('auth:api')->group(function () {
    Route::get('fetch-top-tasks', [RedisTaskController::class, 'fetchTopTasksByPriority']);
    Route::get('saveToRedis', [RedisUserController::class, 'sendTopTasksToUser']);

});