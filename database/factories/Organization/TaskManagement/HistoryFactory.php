<?php

namespace Database\Factories\Organization\TaskManagement;

use App\Models\Organization\TaskManagement\History\History;
use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class HistoryFactory extends Factory
{
    protected $model = History::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_id' => $this->faker->randomElement(Task::pluck('id')),
            'type' => $this->faker->word(),
            'user_id' => $this->faker->randomElement(User::pluck('id')),
        ];
    }
}
