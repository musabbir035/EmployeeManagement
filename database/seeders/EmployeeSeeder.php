<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\EmployeeEducation;
use App\Models\EmployeeExperience;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    public function run()
    {
        Employee::factory(20)->create()->each(
            function ($employee) {
                EmployeeExperience::factory([
                    'employee_id' => $employee->id
                ])->count(rand(0, 3))->create();

                EmployeeEducation::factory([
                    'employee_id' => $employee->id
                ])->count(rand(0, 4))->create();
            }
        );
    }
}
