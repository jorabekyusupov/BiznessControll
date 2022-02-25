<?php

namespace App\Services\Organization\Basic\EmployeePermission;

use App\Repositories\Organization\Basic\EmployeePermission\EmployeePermissionRepository;
use App\Services\Service;

class EmployeePermissionService extends Service
{
    public function __construct(EmployeePermissionRepository $employeePermissionRepository)
    {
        $this->repository = $employeePermissionRepository;
    }

    public function indexEmployeePermission($data)
    {
        $employee_id = $data['employee_id'] ?? null;
        if ($employee_id) return $this->get()->where('employee_id', $employee_id)->get();
        else return $this->getPaginate($data);
    }

}
