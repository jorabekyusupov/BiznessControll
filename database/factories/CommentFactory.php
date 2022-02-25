<?php

namespace Database\Factories;

use App\Models\Organization\TaskManagement\Comment\Comment;
use App\Models\Organization\TaskManagement\Task\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'task_id' => $this->faker->randomElement(Task::all()->pluck('id')),
            'text' => $this->faker->text(50),
            'created_by' => 1
        ];
    }
}
