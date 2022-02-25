<?php

namespace App\Models\Organization\HumanResources\Staff;

use App\Models\Organization\HumanResources\EmployeeStaff\ViewEmployeeStaff;
use App\Models\Organization\Organization;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewStaffPosition extends Organization
{
    use SoftDeletes;

    public function employeeStaff()
    {
        return $this->hasMany(ViewEmployeeStaff::class, 'staff_id', 'id')
            ->where('language_code', auth()->user()->language_code)
            ->where('is_active', 1);
    }
}
