<?php

namespace App\Services\Organization\HumanResources\Staff;

use App\Repositories\Organization\HumanResources\EmployeeStaff\EmployeeStaffRepository;
use App\Repositories\Organization\HumanResources\Staff\StaffRepository;
use App\Services\Organization\HumanResources\EmployeeStaff\EmployeeStaffService;
use App\Services\Service;

class StaffService extends Service
{
    protected EmployeeStaffService $employeeStaffService;

    public function __construct(
        StaffRepository $staffRepository,
        EmployeeStaffService $employeeStaffService
    ) {
        $this->repository = $staffRepository;
        $this->employeeStaffService = $employeeStaffService;
    }

    public function indexStaff($data)
    {
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 100000;
        $filter = $data['filter'] ?? null;
        $sort = $data['sort'] ?? null;

        $model = $this->get()->where('is_active', 1);

        if (isset($sort)) {
            $sort = json_decode($data['sort'], true);
            $model->orderBy($sort['sortField'], $sort['sortOrder'] ?? "ASC");
        } else {
            $model->orderBy('id', "ASC");
        }

        return $model->paginate($rows, ['*'], 'page name', $page);
    }

    public function storeStaff($data)
    {
        $old_staff = $this->get()
            ->where('department_id', $data['department_id'])
            ->where('position_id', $data['position_id'])
            ->first();
        if ($old_staff) {
            $update_data['is_active'] = 1;
            $model = $this->edit($old_staff->id, $update_data);
        } else {
            $model = $this->store($data);
        }
        $model = $model->getData();
         $this->updateEmployeeStaff($model->id);
        return $model;

    }


    public function updateStaff($id, $data)
    {
        $data['updated_at'] = date(now());

        $staff = $this->edit($id, $data)->getData();

        $old_employees_staff = $this->employeeStaffService->get()->where('staff_id', $staff->id)->get();
        if ($old_employees_staff) {
            foreach ($old_employees_staff as $old_employee_staff) {
                $data['is_active'] = 0;
                $this->employeeStaffService->edit($old_employee_staff->id, $data);
            }
        }
        $this->updateEmployeeStaff($staff->id);
        return $staff;
    }
    public function updateEmployeeStaff($staff)
    {
        $employees = request()->input('employees');
        if ($employees) {
            $data['is_active'] = 1;
            foreach ($employees as $employee) {
                $employee_staff = $this->employeeStaffService->get()
                    ->where('staff_id', $staff)->where('employee_id', $employee['id'])->first();

                $data['employee_id'] = $employee['id'];

                if ($employee_staff) {
                    $this->employeeStaffService->edit($employee_staff->id, $data);
                } else {
                    $data['enter_date'] = now();
                    $data['staff_id'] = $staff;
                    $this->employeeStaffService->store($data);
                }
            }
        }
    }

    public function deleteStaff( $id)
    {
        $data['is_active'] = 0;
        $employees_staff = $this->employeeStaffService->get()->where('staff_id', $id)->get();
        foreach ($employees_staff as $employee_staff) {
            $this->employeeStaffService->edit($employee_staff->id, $data);
        }
        $staffRepository = $this->repository->show($id);

        return $this->edit($staffRepository->getData()->id, $data);
    }

}
