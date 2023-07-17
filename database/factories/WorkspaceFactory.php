<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Workspace;
use Illuminate\Database\Eloquent\Factories\Factory;


class WorkspaceFactory extends Factory
{
    protected $model = Workspace::class;

    public function definition()
    {
        return [
            'name' => $this->faker->sentence(2),
            'owner_id' => rand(1, 100), // Generate a random number between 1 and 100 for owner_id
        ];
    }
}
