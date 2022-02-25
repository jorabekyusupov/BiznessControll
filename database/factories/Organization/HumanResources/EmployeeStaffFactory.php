<?php

namespace Database\Factories\Organization\HumanResources;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\HumanResources\EmployeeStaff\EmployeeStaff;
use App\Models\Organization\HumanResources\Staff\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeStaffFactory extends Factory
{
    protected $model = EmployeeStaff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => $this->faker->randomElement(Employee::pluck('id')),
            'staff_id' => $this->faker->randomElement(Staff::pluck('id')),
            'is_active' => $this->faker->randomElement([0, 1]),
            'is_main_staff' => $this->faker->randomElement([0, 1]),
        ];
    }
}
