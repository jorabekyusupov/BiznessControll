<?php

namespace Database\Factories\Organization\Basic;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\Basic\EmployeePermission\EmployeePermission;
use App\Models\Permission;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeePermissionFactory extends Factory
{
    protected $model = EmployeePermission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => $this->faker->randomElement(Employee::pluck('id')),
            'permission_id' => $this->faker->randomElement(Permission::pluck('id')),
        ];
    }
}
