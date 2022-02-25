<?php

namespace Database\Factories\Organization\HumanResources;

use App\Models\Organization\HumanResources\DepartmentType\DepartmentType;
use App\Models\Organization\HumanResources\DepartmentType\DepartmentTypeTranslation;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentTypeTranslationFactory extends Factory
{
    protected $model = DepartmentTypeTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'object_id' => $this->faker->randomElement(DepartmentType::pluck('id')),
            'language_code' => $this->faker->randomElement(['uz', 'ru', 'en']),
            'name' => $this->faker->word(),
        ];
    }
}
