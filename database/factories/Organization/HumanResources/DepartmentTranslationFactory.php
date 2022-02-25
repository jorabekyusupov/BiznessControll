<?php

namespace Database\Factories\Organization\HumanResources;

use App\Models\Organization\HumanResources\Department\Department;
use App\Models\Organization\HumanResources\Department\DepartmentTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentTranslationFactory extends Factory
{
    protected $model = DepartmentTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'object_id' => $this->faker->randomElement(Department::pluck('id')),
            'language_code' => $this->faker->randomElement(['uz', 'ru', 'en']),
            'name' => $this->faker->word(),
        ];
    }
}
