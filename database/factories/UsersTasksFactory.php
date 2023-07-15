<?php

namespace Database\Factories;
use App\Models\Task;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\usersandtasks>
 */
class UsersTasksFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => function () {
                return User::factory()->create()->id;
            },
            'task_id' => function () {
                return Task::factory()->create()->id;
            },
        ];
    }
}
