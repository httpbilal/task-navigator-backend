<?php

use App\Http\Controllers\ProjectController\ProjectController;
use Illuminate\Support\Facades\Route;

// Protected routes
Route::group(['middleware' => ['LogUserActivity', 'auth:api']], function () {
    Route::get('projects', [ProjectController::class, 'index']);
    Route::post('projects', [ProjectController::class, 'store']);
    Route::get('projects/{id}', [ProjectController::class, 'show']);
    Route::put('projects/{id}', [ProjectController::class, 'update']);
    Route::delete('projects/{id}', [ProjectController::class, 'destroy']);
});
