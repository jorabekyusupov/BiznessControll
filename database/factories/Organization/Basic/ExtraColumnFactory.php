<?php

namespace Database\Factories\Organization\Basic;

use App\Models\Master\Organization;
use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\Basic\ExtraColumn\ExtraColumn;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExtraColumnFactory extends Factory
{
    protected $model = ExtraColumn::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => $this->faker->word(),
            'object_type' => $this->faker->word(),
            'list_items' => $this->faker->word(),
            'default_value' => $this->faker->word(),
            'is_required' => $this->faker->boolean(),
        ];
    }
}
