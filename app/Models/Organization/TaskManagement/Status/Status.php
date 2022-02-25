<?php

namespace App\Models\Organization\TaskManagement\Status;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\StatusFactory;

class Status extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = StatusFactory::class;
    
    protected $table = 'tm_statuses';

    protected $fillable = [
        'name',
        'color',
        'sequence',
        'created_by',
        'updated_by'
    ];


}
