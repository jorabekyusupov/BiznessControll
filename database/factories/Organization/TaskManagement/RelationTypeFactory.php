<?php

namespace Database\Factories\Organization\TaskManagement;

use App\Models\Organization\TaskManagement\RelationType\RelationType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RelationTypeFactory extends Factory
{
    protected $model = RelationType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(10),
            'type' => $this->faker->randomElement([0,1]),
        ];
    }
}
