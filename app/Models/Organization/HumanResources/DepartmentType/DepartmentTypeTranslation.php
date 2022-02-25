<?php

namespace App\Models\Organization\HumanResources\DepartmentType;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\HumanResources\DepartmentTypeTranslationFactory;

class DepartmentTypeTranslation extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = DepartmentTypeTranslationFactory::class;
    protected $table = 'hr_department_type_translations';

    public $timestamps = false;
    protected $fillable = [
        'object_id',
        'language_code',
        'name'
    ];

}
