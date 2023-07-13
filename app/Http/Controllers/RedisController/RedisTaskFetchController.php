<?php

namespace App\Http\Controllers\RedisController;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\UsersTasks;
use Illuminate\Support\Facades\Redis;

class RedisTaskFetchController extends Controller
{
    public function fetchTopPriorityTasks(int $userId)
    {
        $userTasks = UsersTasks::where('user_id', $userId)->pluck('task_id');

        $tasks = Task::whereIn('id', $userTasks)
            ->orderBy('priority', 'desc')
            ->take(10)
            ->get();

        // Store the tasks as JSON in Redis
        Redis::set('top_tasks', $tasks->toJson());

        // Logic to send tasks to the user (e.g., return them as a response in an API)
        return response()->json(['tasks' => $tasks]);
    }
}
