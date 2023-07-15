<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Redis;

class SyncTasksCommand extends Command
{
    protected $signature = 'tasks:sync';

    protected $description = 'Synchronize tasks between Redis and PostgreSQL';

    public function handle()
    {
        $userIds = Redis::keys('user_tasks:*');

        foreach ($userIds as $userId) {
            $userId = str_replace('user_tasks:', '', $userId);

            // Retrieve tasks from Redis
            $tasksJson = Redis::smembers('user_tasks:' . $userId);

            if ($tasksJson) {
                $tasks = [];

                foreach ($tasksJson as $taskJson) {
                    $tasks[] = json_decode($taskJson);
                }

                // Retrieve tasks from the database
                $user = User::find($userId);
                $databaseTasks = $user->tasks;

                // Compare tasks and update Redis accordingly
                foreach ($tasks as $task) {
                    $existsInDatabase = $databaseTasks->contains('id', $task->id);

                    if (!$existsInDatabase) {
                        // Task deleted from the database, remove from Redis
                        Redis::srem('user_tasks:' . $userId, json_encode($task));
                    }
                }
            }
        }

        $this->info('Task synchronization completed.');
    }
}
