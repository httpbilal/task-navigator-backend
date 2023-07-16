<?php

namespace App\Listeners;

use App\Events\TaskDeleting;
use Illuminate\Support\Facades\Redis;

class TaskDeletingListener
{
    public function handle(TaskDeleting $event)
    {
        $task = $event->task;

        foreach ($task->users as $user) {
            $key = 'user_tasks:' . $user->id;

            // Remove the task from Redis for this user
            $tasksJson = Redis::smembers($key);
            foreach ($tasksJson as $taskJson) {
                $redisTask = json_decode($taskJson);
                if ($redisTask->id == $task->id) {
                    Redis::srem($key, $taskJson);
                }
            }
        }
    }
}
