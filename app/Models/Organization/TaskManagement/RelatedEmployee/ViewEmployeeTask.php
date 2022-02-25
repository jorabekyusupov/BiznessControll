<?php

namespace App\Models\Organization\TaskManagement\RelatedEmployee;

use App\Models\Organization\Organization;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewEmployeeTask extends Organization
{
    protected $table = 'view_tm_employee_tasks';

    public function owner()
    {
        return $this->hasOne(ViewRelatedEmployee::class, 'task_id', 'id')
            ->where('language_code', auth()->user()->language_code)
            ->where('relation_type_id', 1);
    }

    public function executors()
    {
        return $this->hasMany(ViewRelatedEmployee::class, 'task_id', 'id')
            ->where('language_code', auth()->user()->language_code)
            ->where('relation_type_id', 2);
    }

    public function auditors()
    {
        return $this->hasMany(ViewRelatedEmployee::class, 'task_id', 'id')
            ->where('language_code', auth()->user()->language_code)
            ->where('relation_type_id', 3);
    }

    public function watchers()
    {
        return $this->hasMany(ViewRelatedEmployee::class, 'task_id', 'id')
            ->where('language_code', auth()->user()->language_code)
            ->where('relation_type_id', 4);
    }

}
