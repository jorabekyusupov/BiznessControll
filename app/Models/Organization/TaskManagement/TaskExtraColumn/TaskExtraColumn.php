<?php

namespace App\Models\Organization\TaskManagement\TaskExtraColumn;

use App\Models\Organization\Basic\ExtraColumn\ExtraColumn;
use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\TaskExtraColumnFactory;

class TaskExtraColumn extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = TaskExtraColumnFactory::class;

    protected $table = 'tm_task_extra_columns';

    protected $fillable = [
        'task_id',
        'extra_column_id',
        'value',
        'created_by',
        'updated_by'

    ];

    public function ExtraColumn()
    {
        return $this->hasOne(ExtraColumn::class, 'id', 'extra_column_id');
    }
}

