<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Support\Facades\Redis;

class RedisTaskFetchController extends Controller
{
    public function fetchTopPriorityTasks() {
        $tasks = Task::where('priority', 'high')->orderBy('created_at', 'desc')->take(10)->get();
    
        // Store the tasks as JSON in Redis
        Redis::set('top_tasks', $tasks->toJson());
    
        // Logic to send tasks to the user (e.g., return them as a response in an API)
        return response()->json(['tasks' => $tasks]);
    }
    //
}
