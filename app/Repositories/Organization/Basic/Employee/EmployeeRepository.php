<?php

namespace App\Repositories\Organization\Basic\Employee;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\Basic\Employee\EmployeeTranslation;
use App\Models\Organization\Basic\Employee\ViewEmployee;
use App\Repositories\Repository;

class EmployeeRepository extends Repository
{
    public function __construct(
        Employee $employee,
        EmployeeTranslation $employeeTranslation,
        ViewEmployee $viewEmployee
    )
    {
        $this->model = $employee;
        $this->modelTranslation = $employeeTranslation;
        $this->modelView = $viewEmployee;
    }

}
