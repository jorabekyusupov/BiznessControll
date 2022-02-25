<?php

namespace Database\Factories\Organization\TaskManagement;

use App\Models\Organization\TaskManagement\History\HistoryType;
use App\Traits\NewFactoryTrait;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryTypeFactory extends Factory
{
    use NewFactoryTrait;

    protected static string $model_factory = HistoryTypeFactory::class;

    protected $model = HistoryType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
        ];
    }
}
