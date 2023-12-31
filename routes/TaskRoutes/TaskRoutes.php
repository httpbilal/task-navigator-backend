<?php

use App\Http\Controllers\TaskController\TaskController;
use Illuminate\Support\Facades\Route;

// Protected routes
Route::group(['middleware' => ['LogUserActivity', 'auth:api']], function () {
    Route::get('tasks', [TaskController::class, 'index']);
    Route::post('tasks', [TaskController::class, 'store']);
    Route::get('tasks/{id}', [TaskController::class, 'show']);
    Route::put('tasks/{id}', [TaskController::class, 'update']);
    Route::delete('tasks/{id}', [TaskController::class, 'destroy']);
});
