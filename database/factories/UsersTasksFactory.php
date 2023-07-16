<?php

namespace Database\Factories;
<<<<<<< HEAD
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
=======


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
>>>>>>> bilalwork
        ];
    }
}
