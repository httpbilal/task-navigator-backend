<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedisTaskFetchController extends Controller
{
    //
    $tasks = Task::where('priority', 'high')->orderBy('created_at', 'desc')->take(10)->get();

    // Store the tasks as JSON in Redis
    Redis::set('top_tasks', $tasks->toJson());

    // Logic to send tasks to the user (e.g., return them as a response in an API)
    return response()->json(['tasks' => $tasks]);
}
