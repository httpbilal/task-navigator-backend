<?php

use App\Http\Controllers\AuthController\AuthController;
use Illuminate\Support\Facades\Route;

// Public routes

Route::group(['middleware' => ['LogUserActivity']], function () {
Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => ['LogUserActivity', 'auth:api']], function () {
    Route::post('logout', [AuthController::class, 'logout']);
});
