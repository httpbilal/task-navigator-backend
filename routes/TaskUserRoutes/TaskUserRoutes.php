<?php

use App\Http\Controllers\UsersTasksController\UsersTasksController;
use Illuminate\Support\Facades\Route;

// Protected routes
Route::group(['middleware' => ['auth:api' , 'LogUserActivity']], function () {
    Route::get('ut', [UsersTasksController::class, 'index']);
    Route::post('ut', [UsersTasksController::class, 'store']);
    Route::get('ut/{id}', [UsersTasksController::class, 'show']);
    Route::put('ut/{id}', [UsersTasksController::class, 'update']);
    Route::delete('ut/{id}', [UsersTasksController::class, 'destroy']);
    Route::get('/ut/user/{userId}',[UsersTasksController::class, 'getUserAssignedTasks']);
    Route::get('/ut/task/{taskId}',[UsersTasksController::class, 'getTaskAssignedUsers']);
});
