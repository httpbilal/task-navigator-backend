<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(6),
            'description' => $this->faker->paragraph(2),
            'due_date' => $this->faker->dateTimeBetween('now', '+1 month')->format('Y-m-d'),
            'priority' => $this->faker->randomElement(['high', 'medium', 'low']),
            'project_id' => rand(1, 100), // Assign a random existing project_id or set to null
        ];
    }
}
