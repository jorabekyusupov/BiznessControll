<?php

namespace App\Models\Organization\TaskManagement\Task;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\TaskFactory;

class Task extends Organization
{
    use NewFactoryTrait;

    protected $table = 'tm_tasks';

    protected static string $model_factory = TaskFactory::class;

    protected $fillable = [
        'parent_id',
        'folder_id',
        'type_id',
        'title',
        'is_plan',
        'status_id',
        'expected_result',
        'actual_result',
        'expected_duration',
        'actual_duration',
        'priority_id',
        'description',
        'begin_date',
        'end_date',
        'created_by',
        'updated_by',
    ];

    public function sub_task()
    {
        return $this->hasMany(Task::class, 'parent_id', 'id');
    }
}
