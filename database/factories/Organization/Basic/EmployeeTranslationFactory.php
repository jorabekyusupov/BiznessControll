<?php

namespace Database\Factories\Organization\Basic;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\Basic\Employee\EmployeeTranslation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeTranslationFactory extends Factory
{
    protected $model = EmployeeTranslation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'object_id' => $this->faker->randomElement(Employee::pluck('id')),
            'language_code' => $this->faker->randomElement(['uz', 'ru', 'en']),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'middle_name' => $this->faker->firstName(),
        ];
    }
}
