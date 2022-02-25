<?php

namespace App\Repositories\Organization\HumanResources\Employee;

use App\Models\Organization\HumanResources\Employee\Employee;
use App\Models\Organization\HumanResources\Employee\EmployeeTranslation;
use App\Models\Organization\HumanResources\Employee\ViewEmployee;
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
