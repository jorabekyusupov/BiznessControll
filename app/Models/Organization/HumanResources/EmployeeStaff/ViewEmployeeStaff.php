<?php

namespace App\Models\Organization\HumanResources\EmployeeStaff;

use App\Models\Organization\Organization;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewEmployeeStaff extends Organization
{
    use SoftDeletes;

    protected $table = 'view_hr_employee_staff';

}
