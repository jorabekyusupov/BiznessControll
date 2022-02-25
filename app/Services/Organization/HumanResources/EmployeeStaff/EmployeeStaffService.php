<?php

namespace App\Services\Organization\HumanResources\EmployeeStaff;

use App\Repositories\Organization\HumanResources\EmployeeStaff\EmployeeStaffRepository;
use App\Services\Service;

class EmployeeStaffService extends Service
{
    public function __construct(EmployeeStaffRepository $employeeStaffRepository)
    {
        $this->repository = $employeeStaffRepository;
    }

    public function indexEmployeeStaff($data)
    {
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 10000;

        $staff_id = $data['staff_id'] ?? null;
        $employee_id = $data['employee_id'] ?? null;
        $employee_staff = $this->get(['staff']);

        if (isset($staff_id)) {
            $employee_staff->where('staff_id', $staff_id);
        }

        if (isset($employee_id)) {
            $employee_staff->where('employee_id', $employee_id);
        }

        return $employee_staff->paginate($rows, ['*'], 'page name', $page);

    }
}
