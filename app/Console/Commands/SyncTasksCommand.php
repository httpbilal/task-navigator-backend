<?php

namespace App\Console\Commands;
use App\Models\User;
use App\Models\Task;
use App\Models\UsersTasks;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\Redis;

class SyncTasksCommand extends Command
{
    protected $signature = 'tasks:sync';

    protected $description = 'Synchronize tasks between Redis and PostgreSQL';

    public function handle()
    {
        $userKeys = Redis::keys('user_tasks:*');

        foreach ($userKeys as $userKey) {
            $userId = str_replace('user_tasks:', '', $userKey);

            // Check if the data type of the value associated with the key is a set
            $type = Redis::type($userKey);

            // type '3' corresponds to set in Redis
            if ($type != 'set') {
                continue;
            }

            // Retrieve tasks from Redis
            $tasksJson = Redis::smembers($userKey);

            // Retrieve tasks from the database
            $databaseTasks = Task::whereIn('id', function ($query) use ($userId) {
                $query->select('task_id')
                    ->from('users_tasks')
                    ->where('user_id', $userId);
            })->get();

            $user = User::find($userId);

            // Check if user exists in the database
            if (!$user) {
                // User is deleted, remove all tasks from Redis
                Redis::del($userKey);
                continue;
            }

            // Compare tasks and update Redis accordingly
            foreach ($tasksJson as $taskJson) {
                $task = json_decode($taskJson);

                $existsInDatabase = $databaseTasks->contains('id', $task->id);

                if (!$existsInDatabase) {
                    // Task deleted from the database, remove from Redis
                    Redis::srem($userKey, $taskJson);
                }
            }
        }

        $this->info('Task synchronization completed.');
    }



}
