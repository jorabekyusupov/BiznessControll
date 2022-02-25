<?php

namespace App\Repositories\Organization\Basic\EmployeePermission;

use App\Models\Organization\Basic\EmployeePermission\EmployeePermission;
use App\Repositories\Repository;

class EmployeePermissionRepository extends Repository
{
    public function __construct(EmployeePermission $employeePermission)
    {
        $this->model = $employeePermission;
    }

}
