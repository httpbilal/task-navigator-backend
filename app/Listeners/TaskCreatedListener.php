<?php
// ...
use Illuminate\Support\Facades\Redis;

class TaskCreatedListener
{

    public function handle($event)
    {
        $task = $event->task;

        if ($task->priority === 'high') {
            foreach ($task->users as $user) {
                $existingTasksCount = Redis::scard('user_tasks:' . $user->id);
                if ($existingTasksCount < 10) {
                    Redis::sadd('user_tasks:' . $user->id, $task->toJson());
                }
            }
        }
    }
}
