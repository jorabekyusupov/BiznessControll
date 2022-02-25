<?php

namespace App\Models\Organization\HumanResources\Employee;

use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\User;
use App\Models\Organization\Organization;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Organization\HumanResources\EmployeeStaff\EmployeeStaff;
use App\Models\Organization\TaskManagement\RelatedEmployee\RelatedEmployee;

class Employee extends Organization
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'nationality_id',
        'born_date',
        'gender',
        'first_work_date',
        'leave_date',
        'contract_number',
        'contract_date',
        'phone',
        'telegram',
        'email',
        'note',
        'responsible_id',
        'is_active',
        'is_accessible',
        'inn',
        'inps',
        'created_by',
        'updated_by',
        'deleted_by',
        'updated_at'
    ];

    public function translations()
    {
        return $this->hasMany(EmployeeTranslation::class, 'object_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(EmployeeTranslation::class, 'object_id', 'id')->where('language_code', auth()->user()->language_code);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee_staff()
    {
        return $this->hasMany(EmployeeStaff::class, 'employee_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(RelatedEmployee::class, 'employee_id', 'id');
    }
    public function statusOpen()
    {
        return $this->hasManyThrough(Task::class, RelatedEmployee::class, 'employee_id', 'id')->where('status_id', 1);
    }
    public function statusProcessing()
    {
        return $this->hasManyThrough(Task::class, RelatedEmployee::class, 'employee_id', 'id')->where('status_id', 2);
    }
    public function statusReview()
    {
        return $this->hasManyThrough(Task::class, RelatedEmployee::class, 'employee_id', 'id')->where('status_id', 3);
    }
    public function statusClosed()
    {
        return $this->hasManyThrough(Task::class, RelatedEmployee::class, 'employee_id', 'id')->where('status_id', 4);
    }

}
