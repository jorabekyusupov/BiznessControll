<?php

namespace App\Models\Organization\TaskManagement\RelationType;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\RelationTypeFactory;

class RelationType extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = RelationTypeFactory::class;

    protected $table = 'tm_relation_types';

    protected $fillable = [
        'name',
        'type',
        'created_by',
        'updated_by'
    ];

}
