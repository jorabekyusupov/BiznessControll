<?php

namespace App\Models\Organization\HumanResources\Department;

use App\Models\Organization\HumanResources\DepartmentExtraColumn\DepartmentExtraColumn;
use App\Models\Organization\Basic\ExtraColumn\ExtraColumn;
use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\HumanResources\DepartmentFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = DepartmentFactory::class;

    protected $table = 'hr_departments';
    
    protected $fillable = [
        'parent_id',
        'department_type_id',
        'sequence',
        'single_block',
        'block_color',
        'background_color',
        'text_color',
        'code',
        'created_by',
        'updated_by',
        'deleted_by',
        'updated_at'
    ];

    use SoftDeletes;


    public function extraColumns()
    {
        return $this->hasManyThrough(ExtraColumn::class, DepartmentExtraColumn::class,
            'department_id', 'id', 'id', 'extra_column_id');
    }

    public function translations()
    {
        return $this->hasMany(DepartmentTranslation::class, 'object_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(DepartmentTranslation::class, 'object_id', 'id')->where('language_code', auth()->user()->language_code);
    }

    public function departmentExtraColumns()
    {
        return $this->hasMany(DepartmentExtraColumn::class, 'department_id', 'id');
    }
}
