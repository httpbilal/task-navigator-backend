<?php

use App\Http\Controllers\RedisController\RedisTaskFetchController;
use App\Http\Controllers\RedisController\RedisTaskSaveController;
use Illuminate\Support\Facades\Route;


// Public routes

Route::middleware('auth:api')->group(function () {
    Route::get('fetch-top-tasks/{userId}', [RedisTaskFetchController::class, 'fetchTopPriorityTasks']);
    Route::post('saveToRedis/{userId}', [RedisTaskSaveController::class, 'savePriorityTasks']);

});