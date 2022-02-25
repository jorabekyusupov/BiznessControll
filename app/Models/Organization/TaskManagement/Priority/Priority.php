<?php

namespace App\Models\Organization\TaskManagement\Priority;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\PriorityFactory;

class Priority extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = PriorityFactory::class;

    protected $table = 'tm_priorities';
    protected $fillable = [
        'name',
        'created_by',
        'updated_by'
    ];


}
