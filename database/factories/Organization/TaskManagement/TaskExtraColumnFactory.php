<?php

namespace Database\Factories\Organization\TaskManagement;

use App\Models\Organization\Basic\ExtraColumn\ExtraColumn;
use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\Organization\TaskManagement\TaskExtraColumn\TaskExtraColumn;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskExtraColumnFactory extends Factory
{
    protected $model = TaskExtraColumn::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'extra_column_id' => $this->faker->randomElement(ExtraColumn::pluck('id')),
            'task_id' => $this->faker->randomElement(Task::pluck('id')),
        ];
    }
}
