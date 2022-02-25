<?php

namespace App\Models\Organization\TaskManagement\TaskTag;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\TaskTagFactory;

class TaskTag extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = TaskTagFactory::class;
    
    protected $table = 'tm_task_tags';
    public $timestamps = false;

    protected $fillable = [
        'tag_id',
        'task_id'
    ];


}
