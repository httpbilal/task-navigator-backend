<?php

namespace Database\Factories;

use App\Models\UsersTasks;
use Illuminate\Database\Eloquent\Factories\Factory;

class UsersTasksFactory extends Factory
{
    protected $model = Userstasks::class;

    public function definition()
    {
        return [
            'user_id' => rand(1, 100), // Generate a random number between 1 and 100 for user_id
            'task_id' => rand(1, 100), // Generate a random number between 1 and 100 for task_id
            // Add other fields and their respective random values as needed

        ];
    }
}
