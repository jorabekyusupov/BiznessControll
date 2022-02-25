<?php

namespace Database\Factories\Organization\HumanResources;

use App\Models\Organization\Basic\ExtraColumn\ExtraColumn;
use App\Models\Organization\HumanResources\Department\Department;
use App\Models\Organization\HumanResources\DepartmentExtraColumn\DepartmentExtraColumn;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentExtraColumnFactory extends Factory
{
    protected $model = DepartmentExtraColumn::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'department_id' => $this->faker->randomElement(Department::pluck('id')),
            'extra_column_id' => $this->faker->randomElement(ExtraColumn::pluck('id')),
        ];
    }
}
