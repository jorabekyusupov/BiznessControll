<?php

namespace App\Repositories\Organization\HumanResources\EmployeeStaff;

use App\Models\Organization\HumanResources\EmployeeStaff\EmployeeStaff;
use App\Models\Organization\HumanResources\EmployeeStaff\ViewEmployeeStaff;
use App\Repositories\Repository;

class EmployeeStaffRepository extends Repository
{
    public function __construct(EmployeeStaff $employeeStaff, ViewEmployeeStaff  $viewEmployeeStaff)
    {
        $this->model = $employeeStaff;
        $this->modelView = $viewEmployeeStaff;
    }

}
