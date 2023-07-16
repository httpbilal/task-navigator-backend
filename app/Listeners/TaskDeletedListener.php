<?php

use Illuminate\Support\Facades\Redis;

class TaskDeletedListener
{

    public function handle($event)
    {
        $task = $event->task;
        foreach ($task->users as $user) {
            Redis::srem('user_tasks:' . $user->id, $task->toJson());
        }
    }
}