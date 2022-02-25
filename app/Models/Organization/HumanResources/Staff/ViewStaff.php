<?php

namespace App\Models\Organization\HumanResources\Staff;

use App\Models\Organization\HumanResources\EmployeeStaff\ViewEmployeeStaff;
use App\Models\Organization\Organization;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewStaff extends Organization
{
    use SoftDeletes;

    protected $table = 'view_hr_staff';

    public function employees()
    {
        return $this->hasMany(ViewEmployeeStaff::class, 'staff_id', 'id')
            ->where('language_code', auth()->user()->language_code)
            ->where('is_active', 1);
    }
}
