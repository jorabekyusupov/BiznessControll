<?php

namespace Database\Factories;

use App\Models\Organization\TaskManagement\Task\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => $this->faker->randomElement([null, null, null, null, null, null, null, null, null, 1, 2, 3]),
            'type_id' => $this->faker->numberBetween(1, 4),
            'title' => $this->faker->words(3, true),
            'is_plan' => $this->faker->boolean(),
            'status_id' => $this->faker->numberBetween(1, 4),
            'expected_result' => $this->faker->words(1, true),
            'actual_result' => $this->faker->words(1, true),
            'expected_duration' => $this->faker->numberBetween(1, 60),
            'actual_duration' => $this->faker->numberBetween(1, 60),
            'priority_id' => $this->faker->numberBetween(1, 4),
            'description' => $this->faker->words(7, true),
//            'begin_date' => $this->faker->dateTime(),
            'end_date' => $this->faker->dateTime()
        ];
    }
}
