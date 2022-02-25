<?php

namespace Database\Factories\Master;

use App\Models\Master\OrganizationLanguage;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationLanguageFactory extends Factory
{
    protected $model = OrganizationLanguage::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'organization_id' => $this->faker->unique()->numberBetween(1, 50),
            'language_id' => $this->faker->unique()->numberBetween(1, 50),
            'is_default' => $this->faker->boolean(),
        ];
    }
}
