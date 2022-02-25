<?php

namespace App\Models\Organization\TaskManagement\EmployeeFavoriteTask;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\EmployeeFavoriteTaskFactory;

class EmployeeFavoriteTask extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = EmployeeFavoriteTaskFactory::class;

    protected $table = 'tm_employee_favorite_tasks';

    protected $fillable = [
        'employee_id',
        'task_id'
    ];
}
