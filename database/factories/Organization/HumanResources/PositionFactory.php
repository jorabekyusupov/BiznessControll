<?php

namespace Database\Factories\Organization\HumanResources;

use App\Models\Organization\HumanResources\Position\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    protected $model = Position::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'position_type_id' => 1,
            'code' => substr($this->faker->word(),0,10),
        ];
    }
}
