<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition()
    {
        $email = $this->faker->unique()->safeEmail;

        return [
            'firstname' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'image' => null,
<<<<<<< HEAD
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // Update this with your desired default password
=======
            'email' => $email,
            'password' => bcrypt(Str::random(10)),
>>>>>>> bilalwork
        ];
    }
}



