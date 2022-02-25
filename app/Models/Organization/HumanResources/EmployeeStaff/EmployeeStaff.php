<?php

namespace App\Models\Organization\HumanResources\EmployeeStaff;

use App\Models\Organization\HumanResources\Staff\ViewStaff;
use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\HumanResources\EmployeeStaffFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeStaff extends Organization
{
    use SoftDeletes, NewFactoryTrait;

    protected static string $model_factory = EmployeeStaffFactory::class;
    protected $table = 'hr_employee_staff';

    protected $fillable = [
        'employee_id',
        'staff_id',
        'is_active',
        'is_main_staff',
        'enter_date',
        'leave_date',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function staff()
    {
        return $this->hasOne(ViewStaff::class, 'id', 'staff_id')
            ->where(function ($query) {
                $query->where('position_language_code', auth()->user()->language_code)
                    ->where('department_language_code', auth()->user()->language_code);
            });
    }

}
