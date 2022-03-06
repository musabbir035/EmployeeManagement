<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeEducationFactory extends Factory
{
    public function definition()
    {
        return [
            'exam' => $this->faker->text(50),
            'passing_year' => $this->faker->year(),
            'result' => $this->faker->text(20),
            'result_scale' => $this->faker->text(20),
            'institution' => $this->faker->text(100),
        ];
    }
}
