<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'roll' => $this->faker->text(10),
            'phone' => '01' . $this->faker->numerify('#########'),
            'email' => $this->faker->safeEmail(),
            'designation' => $this->faker->text(20),
            'department' => $this->faker->text(30),
        ];
    }
}
