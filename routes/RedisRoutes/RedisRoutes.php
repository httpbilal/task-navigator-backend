<?php
use App\Http\Controllers\RedisController\RedisTaskSaveController;
use App\Http\Controllers\RedisController\RedisTaskFetchController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::middleware('auth:api')->group(function () {
Route::get('fetch-top-tasks/{id}', [RedisTaskFetchController::class, 'fetchTopPriorityTasks']);
Route::get('saveToRedis/{id}', [RedisTaskSaveController::class, 'savePriorityTasks']);
});
