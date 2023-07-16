<?php

use App\Http\Controllers\LogController\Log_activityController;
use Illuminate\Support\Facades\Route;

// Protected routes
Route::group(['middleware' => ['LogUserActivity']], function () {
    Route::get('user_logs', [Log_activityController::class, 'index']);
    Route::get('user_log/{email}', [Log_activityController::class, 'show']);
    Route::delete('destory_log/{email}', [Log_activityController::class, 'destroy']);
});