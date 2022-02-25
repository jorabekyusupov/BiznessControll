<?php

namespace Database\Factories\Organization\HumanResources;

use App\Models\Organization\HumanResources\Department\Department;
use App\Models\Organization\HumanResources\Position\Position;
use App\Models\Organization\HumanResources\Staff\Staff;
use Illuminate\Database\Eloquent\Factories\Factory;

class StaffFactory extends Factory
{
    protected $model = Staff::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'department_id' => $this->faker->randomElement(Department::pluck('id')),
            'position_id' => $this->faker->randomElement(Position::pluck('id')),
            'is_active' => $this->faker->randomElement([0, 1]),
        ];
    }
}
