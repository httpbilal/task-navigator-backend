<?php

use App\Http\Controllers\RedisController\RedisTaskFetchController;
use App\Http\Controllers\RedisTaskSaveController;
use Illuminate\Support\Facades\Route;


// Public routes

Route::middleware('auth:api')->group(function () {
    Route::get('fetch-top-tasks', [RedisTaskFetchController::class, 'fetchTopPriorityTasks']);
    Route::get('saveToRedis', [RedisTaskSaveController::class, 'savePriorityTasks']);

});