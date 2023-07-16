<?php
namespace App\Listeners;

use Illuminate\Support\Facades\Redis;
use App\Models\Task;

class UsersTasksDeletedListener
{
    public function handle($event)
    {
        $usersTasks = $event->usersTasks;

        $task = Task::find($usersTasks->task_id);
        $user = $usersTasks->user_id;

        Redis::srem('user_tasks:' . $user, $task->toJson());
    }
}

