<?php

namespace Database\Factories\Organization\TaskManagement;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\TaskManagement\Folder\Folder;
use App\Models\Organization\TaskManagement\FolderEmployee\FolderEmployee;
use Illuminate\Database\Eloquent\Factories\Factory;

class FolderEmployeeFactory extends Factory
{
    protected $model = FolderEmployee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'folder_id' => $this->faker->randomElement(Folder::pluck('id')),
            'employee_id' => $this->faker->randomElement(Employee::pluck('id')),
        ];
    }
}
