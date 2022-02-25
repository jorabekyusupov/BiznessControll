<?php

namespace Database\Factories\Master;

use App\Models\Master\OrganizationModule;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationModuleFactory extends Factory
{
    protected $model = OrganizationModule::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organization_id' => $this->faker->unique()->numberBetween(1, 150),
            'module_id' => $this->faker->unique()->numberBetween(1, 150),
            'status' => $this->faker->boolean()
        ];
    }
}
