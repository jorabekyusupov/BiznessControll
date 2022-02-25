<?php

namespace App\Models\Organization\HumanResources\Employee;

use App\Models\Organization\HumanResources\EmployeeStaff\EmployeeStaff;
use App\Models\Organization\Organization;
use App\Models\Organization\TaskManagement\RelatedEmployee\RelatedEmployee;
use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewEmployee extends Organization
{
    use SoftDeletes;

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

    public function responsible()
    {
        return $this->hasOne(ViewEmployee::class, 'id', 'responsible_id');
    }

    public function task()
    {
        return $this->hasManyThrough(Task::class, RelatedEmployee::class, 'employee_id', 'id');
    }

    public function statusOpen()
    {
        return $this->task()->where('status_id', 1);
    }

    public function statusProcessing()
    {
        return $this->task()->where('status_id', 2);
    }

    public function statusReview()
    {
        return $this->task()->where('status_id', 3);
    }

    public function statusClosed()
    {
        return $this->task()->where('status_id', 4);
    }
}
