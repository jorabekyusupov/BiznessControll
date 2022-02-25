<?php

namespace App\Models\Organization\HumanResources\DepartmentType;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\HumanResources\DepartmentTypeFactory;

class DepartmentType extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = DepartmentTypeFactory::class;
    
    protected $table = 'hr_department_types';

    protected $fillable = ['sequence', 'created_by',
    'updated_by',
    'deleted_by',
    'updated_at'
];
    public function translations()
    {
        return $this->hasMany(DepartmentTypeTranslation::class, 'object_id', 'id');
    }
    public function translation()
    {
        return $this->hasOne(DepartmentTypeTranslation::class,'object_id','id');
    }

}
