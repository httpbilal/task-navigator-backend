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

                $existingTasksCount = Redis::scard('user_tasks:' . $user->id);
                $remainingSlots = 10 - $existingTasksCount;

                if ($remainingSlots <= 0) {
                        return response()->json(['message' => 'Task limit reached for the user'], 403);
                }

                $tasks = $user->tasks()
                        ->where('priority', 'high')
                        ->orderBy('priority', 'desc')
                        ->take($remainingSlots)
                        ->get();

                if ($tasks->isEmpty()) {
                        return response()->json(['message' => 'No high priority tasks found'], 404);
                }

                // Store the tasks in Redis
                foreach ($tasks as $task) {
                        Redis::sadd('user_tasks:' . $user->id, $task->toJson());
                }

                return response()->json(['message' => 'Tasks saved successfully'], 200);
        }




        public function fetchTopPriorityTasks(int $userId)
        {
                $user = User::find($userId);

                if (!$user) {
                        return response()->json(['message' => 'User not found'], 404);
                }

                $tasksJson = Redis::smembers('user_tasks:' . $user->id);

                if (empty($tasksJson)) {
                        return response()->json(['message' => 'No tasks found for the user in Redis'], 404);
                }

                $tasks = [];

                foreach ($tasksJson as $taskJson) {
                        $tasks[] = json_decode($taskJson);
                }

                return response()->json(['tasks' => $tasks]);
        }




}
