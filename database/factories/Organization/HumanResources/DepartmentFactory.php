<?php

namespace Database\Factories\Organization\HumanResources;

use App\Models\Organization\HumanResources\Department\Department;
use App\Models\Organization\HumanResources\DepartmentType\DepartmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'department_type_id' => $this->faker->randomElement(DepartmentType::pluck('id')),
            'sequence' => 1,
            'single_block' => $this->faker->boolean(),
            'code' =>  substr($this->faker->word(), 0, 15),
        ];
    }
}
