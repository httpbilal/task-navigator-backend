<?php
namespace App\Listeners;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Log;

class TaskUpdatedListener
{
    // ...

    public function handle($task)
    {
        Log::info('TaskUpdatedListener is running for task id: ' . $task->id);
        foreach ($task->users as $user) {
            $key = 'user_tasks:' . $user->id;

            // Remove all tasks from Redis for this user
            Redis::del($key);

            // Get updated tasks for the user from the database
            $updatedTasks = $user->tasks()
                ->where('priority', 'high')
                ->orderBy('priority', 'desc')
                ->take(10)
                ->get();

            // Store the updated tasks back to Redis
            foreach ($updatedTasks as $updatedTask) {
                Redis::sadd($key, $updatedTask->toJson());
            }
        }
    }

}
