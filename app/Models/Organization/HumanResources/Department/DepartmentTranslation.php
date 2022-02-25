<?php

namespace App\Models\Organization\HumanResources\Department;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\HumanResources\DepartmentTranslationFactory;

class DepartmentTranslation extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = DepartmentTranslationFactory::class;
    
    protected $table = 'hr_department_translations';

    public $timestamps = false;

    protected $fillable = [
        'object_id',
        'language_code',
        'name'
    ];
}
