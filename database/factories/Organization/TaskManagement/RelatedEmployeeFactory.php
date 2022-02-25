<?php

namespace Database\Factories\Organization\TaskManagement;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\TaskManagement\RelatedEmployee\RelatedEmployee;
use App\Models\Organization\TaskManagement\Status\Status;
use App\Models\Organization\TaskManagement\Task\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class RelatedEmployeeFactory extends Factory
{
    protected $model = RelatedEmployee::class;

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
            'status_id' => $this->faker->randomElement(Status::pluck('id')),
        ];
    }
}
