<?php

namespace App\Http\Controllers\RedisController;
use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Support\Facades\Redis;

class RedisTaskSaveController extends Controller
{
        public function savePriorityTasks() {
                $tasks = Task::orderBy('priority', 'desc')->take(10)->get();
                Redis::set('top_tasks', $tasks->toJson());
        }
}
