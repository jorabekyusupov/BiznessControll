<?php

namespace App\Models\Organization\TaskManagement\Type;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\TypeFactory;

class Type extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = TypeFactory::class;
    
    protected $table = 'tm_types';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by'
    ];


}
