<?php

use App\Http\Controllers\LogController\Log_activityController;
use Illuminate\Support\Facades\Route;

// Protected routes
Route::group(['middleware' => ['auth:api' ,'LogUserActivity']], function () {
    Route::get('user-logs', [Log_activityController::class, 'index']);
    Route::get('user-logs/nonauth', [Log_activityController::class, 'record']);
    Route::get('user-logs/auth', [Log_activityController::class, 'showAuthenticated']);
    Route::get('user-log/{email}', [Log_activityController::class, 'show']);
    Route::delete('destroy-log/{email}', [Log_activityController::class, 'destroy']);
});
