<?php
namespace App\Listeners;

use Illuminate\Support\Facades\Redis;
use App\Models\Task;

class UsersTasksCreatedListener
{
    public function handle($event)
    {
        $usersTasks = $event->usersTasks;

        $task = Task::find($usersTasks->task_id);
        $user = $usersTasks->user_id;

        if ($task->priority === 'high') {
            $existingTasksCount = Redis::scard('user_tasks:' . $user);
            if ($existingTasksCount < 10) {
                Redis::sadd('user_tasks:' . $user, $task->toJson());
            }
        }
    }
}

