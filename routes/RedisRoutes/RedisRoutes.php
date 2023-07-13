<?php

<<<<<<< Updated upstream
use App\Http\Controllers\RedisController\RedisTaskFetchController;
use App\Http\Controllers\RedisController\RedisTaskSaveController;
=======
use App\Http\Controllers\RedisTaskFetchController;
use App\Http\Controllers\RedisTaskSaveController;
>>>>>>> Stashed changes
use Illuminate\Support\Facades\Route;


// Public routes

Route::middleware('auth:api')->group(function () {
<<<<<<< Updated upstream
    Route::get('fetch-top-tasks/{id}', [RedisTaskFetchController::class, 'fetchTopPriorityTasks']);
    Route::get('saveToRedis/{id}', [RedisTaskSaveController::class, 'savePriorityTasks']);
=======
    Route::get('fetch-top-tasks', [RedisTaskFetchController::class, 'fetchTopTasksByPriority']);
    Route::get('saveToRedis', [RedisTaskSaveController::class, 'sendTopTasksToUser']);
>>>>>>> Stashed changes

});
