<?php

namespace App\Models\Organization\HumanResources\Department;

use App\Models\Organization\HumanResources\DepartmentExtraColumn\DepartmentExtraColumn;
use App\Models\Organization\Basic\ExtraColumn\ViewExtraColumn;
use App\Models\Organization\HumanResources\Staff\ViewStaff;
use App\Models\Organization\Organization;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewDepartment extends Organization
{
    use SoftDeletes;

    protected $table = 'view_hr_departments';

    public function extraColumns()
    {
        return $this->hasManyThrough(ViewExtraColumn::class, DepartmentExtraColumn::class,
            'department_id', 'id', 'id', 'extra_column_id');
    }

    public function staff()
    {
        return $this->hasMany(ViewStaff::class, 'department_id', 'id')
            ->where('is_active', 1)
            ->where(function ($query) {
                $query->where('position_language_code', auth()->user()->language_code)
                    ->where('department_language_code', auth()->user()->language_code);
            });
    }

    public function departmentExtraColumns()
    {
        return $this->hasMany(DepartmentExtraColumn::class, 'department_id', 'id');
    }
}
