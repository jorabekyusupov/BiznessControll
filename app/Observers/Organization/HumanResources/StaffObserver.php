<?php

namespace App\Observers\Organization\HumanResources;

use App\Models\Organization\HumanResources\Staff\Staff;
use App\Services\Organization\HumanResources\EmployeeStaff\EmployeeStaffService;

class StaffObserver
{
    protected EmployeeStaffService $employeeStaffService;

    public function __construct(
        EmployeeStaffService $employeeStaffService
    )
    {
        $this->employeeStaffService = $employeeStaffService;
    }

    public function created(Staff $staff)
    {
        $this->updateEmployeeStaff($staff->id);
    }

    public function updated(Staff $staff)
    {
        //
    }

    public function updateEmployeeStaff($staff)
    {
        $employees = request()->input('employees');
        if ($employees) {
            $data['staff_id'] = $staff;
            $data['enter_date'] = now();
            $data['is_active'] = 1;
            foreach ($employees as $employee) {
                $employee_staff = $this->employeeStaffService->get()
                    ->where('staff_id', $staff)->where('employee_id', $employee['id'])->get();
                $data['employee_id'] = $employee['id'];

                if ($employee_staff) {
                    return $data;
                    $this->employeeStaffService->edit($employee_staff->id, $data);
                } else {
                    $data['staff_id'] = $staff;
                    $this->employeeStaffService->store($data);
                }
            }
        }
    }


    public function deleted(Staff $staff)
    {
        //
    }

    public function restored(Staff $staff)
    {
        //
    }

    public function forceDeleted(Staff $staff)
    {
        //
    }
}
