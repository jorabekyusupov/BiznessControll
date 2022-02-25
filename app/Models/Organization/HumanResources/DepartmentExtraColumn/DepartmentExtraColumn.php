<?php

namespace App\Models\Organization\HumanResources\DepartmentExtraColumn;

use App\Models\Organization\Basic\ExtraColumn\ViewExtraColumn;
use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\HumanResources\DepartmentExtraColumnFactory;

class DepartmentExtraColumn extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = DepartmentExtraColumnFactory::class;
    
    protected $table = 'hr_department_extra_columns';

    protected $fillable = [
        'department_id',
        'extra_column_id',
        'value',
        'created_by',
        'updated_by'
    ];

    public function extraColumns()
    {
        return $this->hasOne(ViewExtraColumn::class, 'id', 'extra_column_id');
    }
}
