<?php

namespace Database\Factories\Organization\TaskManagement;

use App\Models\Organization\TaskManagement\Tag\Tag;
use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\Organization\TaskManagement\TaskTag\TaskTag;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskTagFactory extends Factory
{
    protected $model = TaskTag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tag_id' => $this->faker->randomElement(Tag::pluck('id')),
            'task_id' => $this->faker->randomElement(Task::pluck('id')),
        ];
    }
}
