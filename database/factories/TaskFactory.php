<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(6), // generates a sentence with 6 words
            'description' => $this->faker->paragraph(2), // generates a paragraph with 2 sentences
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'priority' => $this->faker->randomElement(['high', 'medium', 'low']),
            'assignees' => null,
        ];
    }
}
