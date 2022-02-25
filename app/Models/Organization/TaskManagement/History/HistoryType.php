<?php

namespace App\Models\Organization\TaskManagement\History;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\HistoryTypeFactory;

class HistoryType extends Organization
{

    use NewFactoryTrait;

    protected static string $model_factory = HistoryTypeFactory::class;

    protected $table = 'tm_history_types';
    protected $fillable = [
        'name',
        'created_by',
        'updated_by'
    ];

}
