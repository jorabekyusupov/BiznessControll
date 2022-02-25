<?php

namespace Database\Factories\Organization\HumanResources;

use App\Models\Organization\HumanResources\DepartmentType\DepartmentType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentTypeFactory extends Factory
{
    protected $model = DepartmentType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'sequence' => 1,
        ];
    }
}
