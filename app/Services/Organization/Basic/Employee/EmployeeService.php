<?php

namespace App\Services\Organization\Basic\Employee;

use App\Repositories\Organization\Basic\Employee\EmployeeRepository;
use App\Services\Master\User\UserService;
use App\Services\Organization\HumanResources\EmployeeStaff\EmployeeStaffService;
use App\Services\Service;

class EmployeeService extends Service
{
    protected EmployeeStaffService $employeeStaffService;

    public function __construct(
        EmployeeRepository   $employeeRepository,
        EmployeeStaffService $employeeStaffService)
    {
        $this->repository = $employeeRepository;
        $this->employeeStaffService = $employeeStaffService;
    }

    public function indexEmployee($data)
    {
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 100000;
        $filter = $data['filter'] ?? null;
        $sort = $data['sort'] ?? null;

        $model = $this->repository->queryView(['user'])
            ->where('language_code', auth()->user()->language_code)
            ->with('employee_staff', function ($query) {
                $query->where('is_active', 1)->with('staff');
            });

        if (isset($sort)) {
            $sort = json_decode($sort, true);
            $model->orderBy($sort['sortField'], $sort['sortOrder'] ?? "ASC");
        } else {
            $model->orderBy('id', "ASC");
        }

        if (isset($filter)) {
            $filter = json_decode($filter, true);

            $global = $filter['global'] ?? null;
            $position = $filter['position_id'] ?? null;
            $show_dismissed = $filter['show_dismissed'] ?? false;
            $range_born_date = $filter['range_born_date'] ?? null;
            $contract_date = $filter['contract_date'] ?? null;
            $leave_date = $filter['leave_date'] ?? null;
            $responsible = $filter['responsible'] ?? null;
            $gender = $filter['gender'] ?? null;

            if (isset($global)) {
                $model->where('first_name', 'ilike', '%' . $global . '%')
                    ->orWhere('last_name', 'ilike', '%' . $global . '%')
                    ->orWhere('middle_name', 'ilike', '%' . $global . '%')
                    ->orWhere('phone', 'ilike', '%' . $global . '%')
                    ->orWhere('inn', 'ilike', '%' . $global . '%')
                    ->orWhere('inps', 'ilike', '%' . $global . '%')
                    ->orWhere('email', 'ilike', '%' . $global . '%');
            }

            if (isset($position)) {
                $model->whereHas('employee_staff', function ($query) use ($position) {
                    $query->whereHas('staff', function ($sub_query) use ($position) {
                        $sub_query->where('position_id', $position);
                    });
                });
            }

            if (!$show_dismissed) {
                $model->where('is_active', 1);
            }

            if (isset($range_born_date)) {
                $model->whereBetween('born_date', [$range_born_date['start'], $range_born_date['end']]);
            }

            if (isset($contract_date)) {
                $model->whereBetween('contract_date', [$contract_date['start'], $contract_date['end']]);
            }

            if (isset($leave_date)) {
                $model->whereBetween('leave_date', [$leave_date['start'], $leave_date['end']]);
            }

            if (isset($responsible)) {
                $model->where('responsible_id', $responsible);
            }

            if (isset($gender)) {
                $model->where('gender', $gender);
            }

        } else {
            $model->where('is_active', 1);
        }


        return $model->paginate($rows, ['*'], 'page name', $page);
    }
//
//    public function storeEmployee($data, $translations)
//    {
//        $data['password'] = bcrypt($data['password']);
//        $model = $this->store($data, $translations);
//        return $model;
//
//    }
//
//    public function updateEmployee($id, $data, $translations)
//    {
//        $data['updated_at'] = now();
//        $model = $this->edit($id, $data, $translations);
//        $employee_main_staff = request()->input('employee_main_staff_id');
//        if ($employee_main_staff) {
//            $employees_staff = $this->employeeStaffService->get()->where('employee_id', $model->id)->get();
//            foreach ($employees_staff as $employee_staff) {
//                $employee_staff->id == $employee_main_staff ?
//                    $employee_staff_data['is_main_staff'] = 1 :
//                    $employee_staff_data['is_main_staff'] = 0;
//
//                $this->employeeStaffService->edit($employee_staff->id, $employee_staff_data);
//            }
//        }
//        return $model;
//
//    }
//

    public function deleteEmployee($id)
    {
        $this->employeeStaffService->get()->where('employee_id', $id)->update(['is_active' => 0]);

        $data['is_active'] = 0;
        $data['leave_date'] = now();

        return $this->edit($id, $data);

    }
}
