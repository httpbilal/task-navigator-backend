<?php

use App\Http\Controllers\RedisController\RedisController;
use Illuminate\Support\Facades\Route;

// Public routes

Route::group(['middleware' => ['LogUserActivity', 'auth:api']], function () {
    Route::get('fetch-top-tasks/{userId}', [RedisController::class, 'fetchTopPriorityTasks']);

});
