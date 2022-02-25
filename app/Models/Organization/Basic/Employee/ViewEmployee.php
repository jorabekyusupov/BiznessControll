<?php

namespace App\Models\Organization\Basic\Employee;

use App\Models\Master\Picture;
use App\Models\Master\UserOrganization;
use App\Models\Organization\HumanResources\EmployeeStaff\EmployeeStaff;
use App\Models\Organization\HumanResources\Staff\ViewStaff;
use App\Models\Organization\Organization;
use App\Models\Organization\TaskManagement\RelatedEmployee\RelatedEmployee;
use App\Models\Organization\TaskManagement\Task\ViewTasks;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewEmployee extends Organization
{
    use SoftDeletes;

    public function avatar()
    {
        return $this->hasOne(Picture::class, 'object_id', 'user_id')
            ->where('object_id', 1)
            ->where('is_default', 1);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee_staff()
    {
        return $this->hasMany(EmployeeStaff::class, 'employee_id', 'id');
    }

    public function employee_main_staff()
    {
        return $this->hasOne(EmployeeStaff::class, 'employee_id', 'id')
            ->where('is_main_staff', 1);
    }

    public function staff()
    {
        return $this->hasManyThrough(ViewStaff::class, RelatedEmployee::class, 'employee_id', 'id');
    }

    public function responsible()
    {
        return $this->hasMany(RelatedEmployee::class, 'employee_id', 'id');
    }

    public function owner()
    {
        return $this->hasMany(RelatedEmployee::class, 'employee_id', 'id')
            ->where('relation_type_id', 1);
    }

    public function executor()
    {
        return $this->hasMany(RelatedEmployee::class, 'employee_id', 'id')
            ->where('relation_type_id', 2);
    }

    public function auditor()
    {
        return $this->hasMany(RelatedEmployee::class, 'employee_id', 'id')
            ->where('relation_type_id', 3);
    }

    public function watcher()
    {
        return $this->hasMany(RelatedEmployee::class, 'employee_id', 'id')
            ->where('relation_type_id', 4);
    }

    public function task()
    {
        return $this->hasMany(RelatedEmployee::class, 'employee_id', 'id');
    }

    public function user_organizations()
    {
        return $this->hasMany(UserOrganization::class, 'user_id', 'user_id');
    }
}
