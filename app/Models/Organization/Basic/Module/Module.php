<?php

namespace App\Models\Organization\Basic\Module;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\Basic\ModuleFactory;

class Module extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = ModuleFactory::class;
    
    protected $fillable = [
        'module_id',
        'is_active',
        'created_by',
        'updated_by'
    ];
}
