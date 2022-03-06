<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeExperienceFactory extends Factory
{
    public function definition()
    {
        $rangeStart = strtotime('-5 years');
        $rangeEnd = strtotime('-1 year');
        $start = rand($rangeStart, $rangeEnd);
        $end = rand($start, strtotime('-1 month'));

        return [
            'organization' => $this->faker->text(40),
            'from_date' => date('Y-m-d', $start),
            'to_date' => date('Y-m-d', $end),
            'designation' => $this->faker->text(20),
            'duties' => $this->faker->paragraph(10)
        ];
    }
}
