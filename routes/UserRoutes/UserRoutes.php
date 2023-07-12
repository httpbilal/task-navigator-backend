<?php

use App\Http\Controllers\UserControllers\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::post('register', [UserController::class, 'register']);

// Protected routes
Route::middleware('auth:api')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
});
