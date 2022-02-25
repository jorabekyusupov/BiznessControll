<?php

namespace Database\Factories\Master;

use App\Models\Master\UserOrganization;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserOrganizationFactory extends Factory
{
    protected $model = UserOrganization::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'=>$this->faker->unique()->numberBetween(1,50),
            'organization_id'=>$this->faker->unique()->numberBetween(1,50)
        ];
    }
}
