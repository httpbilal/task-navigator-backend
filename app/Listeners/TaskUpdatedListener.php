<?php
use Illuminate\Support\Facades\Redis;

class TaskUpdatedListener
{
    // ...

    public function handle($event)
    {
        $task = $event->task;

        // If priority is updated to high
        if ($task->isDirty('priority') && $task->priority === 'high') {
            foreach ($task->users as $user) {
                $existingTasksCount = Redis::scard('user_tasks:' . $user->id);
                if ($existingTasksCount < 10) {
                    Redis::sadd('user_tasks:' . $user->id, $task->toJson());
                }
            }
        }

        // If priority is updated from high to another priority
        if ($task->isDirty('priority') && $task->getOriginal('priority') === 'high') {
            foreach ($task->users as $user) {
                Redis::srem('user_tasks:' . $user->id, $task->toJson());
            }
        }
    }
}
