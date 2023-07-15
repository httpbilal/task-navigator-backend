<?php

namespace App\Http\Controllers\RedisController;
use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\User;
use App\Models\UsersTasks;
use Illuminate\Support\Facades\Redis;

class RedisController extends Controller
{
        public function savePriorityTasks(int $user_id)
        {
                $user = User::find($user_id);

                if (!$user) {
                        return response()->json(['message' => 'User not found'], 404);
                }

                $tasks = $user->tasks()->orderBy('priority', 'desc')->take(10)->get();

                if ($tasks->count() === 0) {
                        return response()->json(['message' => 'Task not found'], 404);
                }

                Redis::set('user_tasks:' . $user->id, $tasks->toJson());

                return response()->json(['message' => 'Tasks saved successfully'], 200);
        }


        public function fetchTopPriorityTasks(int $userId)
        {
                $tasksJson = Redis::get('user_tasks:' . $userId);

                if (!$tasksJson) {
                        return response()->json(['message' => 'No tasks found for the user in Redis'], 404);
                }

                $tasks = json_decode($tasksJson);

                return response()->json(['tasks' => $tasks]);
        }


}
