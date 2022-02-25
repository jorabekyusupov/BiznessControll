<?php

namespace Database\Factories\Organization\TaskManagement;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\TaskManagement\EmployeeFavoriteTask\EmployeeFavoriteTask;
use App\Models\Organization\TaskManagement\Task\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFavoriteTaskFactory extends Factory
{
    protected $model = EmployeeFavoriteTask::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'employee_id' => $this->faker->randomElement(Employee::pluck('id')),
            'task_id' => $this->faker->randomElement(Task::pluck('id')),
        ];
    }
}
