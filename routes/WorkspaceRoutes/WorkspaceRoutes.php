<?php

use App\Http\Controllers\WorkspacesController\WorkspacesController;
use Illuminate\Support\Facades\Route;

// Protected routes
Route::middleware(['LogUserActivity', 'auth:api'])->group(function () {
    Route::get('workspaces', [WorkspacesController::class, 'index']);
    Route::post('workspaces', [WorkspacesController::class, 'store']);
    Route::get('workspaces/{id}', [WorkspacesController::class, 'show']);
    Route::put('workspaces/{id}', [WorkspacesController::class, 'update']);
    Route::delete('workspaces/{id}', [WorkspacesController::class, 'destroy']);
});
