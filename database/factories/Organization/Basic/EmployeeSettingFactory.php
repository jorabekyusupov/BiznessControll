<?php

namespace Database\Factories\Organization\Basic;

use App\Models\Master\Organization;
use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\Basic\EmployeeSetting\EmployeeSetting;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeSettingFactory extends Factory
{
    protected $model = EmployeeSetting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => $this->faker->randomElement(Employee::pluck('id')),
            'default_organization' => $this->faker->randomElement(Organization::pluck('id')),
            'default_language' => 1,
        ];
    }
}
