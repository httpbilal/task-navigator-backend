<?php

use App\Http\Controllers\UserController\UserController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::group(['middleware' => 'LogUserActivity'], function () {
Route::post('register', [UserController::class, 'register']);
});


// Protected routes
Route::group(['middleware' => ['auth:api' , 'LogUserActivity']], function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::put('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
});

