<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Redis;
use App\Models\User;

class UsersTasksDeletedListener
{
    public function handle($usersTasks)
    {
        // Remove the deleted task from Redis for this user
        Redis::srem('user_tasks:' . $usersTasks->user_id, $usersTasks->task->toJson());

        // Get updated tasks for the user from the database
        $user = User::find($usersTasks->user_id);
        $updatedTasks = $user->tasks()
            ->where('priority', 'high')
            ->orderBy('priority', 'desc')
            ->take(10)
            ->get();

        // Store the updated tasks back to Redis
        foreach ($updatedTasks as $updatedTask) {
            Redis::sadd('user_tasks:' . $usersTasks->user_id, $updatedTask->toJson());
        }
    }
}
