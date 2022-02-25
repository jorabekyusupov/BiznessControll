<?php

namespace Database\Factories\Organization\Basic;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->randomElement(User::pluck('id')),
            'gender' => $this->faker->randomElement([1]),
            'is_active' => $this->faker->randomElement([1,0]),
            'is_accessible' => $this->faker->randomElement([1,0]),
        ];
    }
}
