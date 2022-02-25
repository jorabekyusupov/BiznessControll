<?php

namespace App\Models\Organization\TaskManagement\Tag;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\TagFactory;

class Tag extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = TagFactory::class;
    
    protected $table = 'tm_tags';

    protected $fillable = [
        'name',
        'created_by',
        'updated_by'
    ];
}
