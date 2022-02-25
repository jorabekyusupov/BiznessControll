<?php

namespace App\Observers\Organization\Basic;

use App\Models\Master\Language;
use App\Models\Organization\Basic\Employee\Employee;
use App\Services\Master\User\UserService;
use App\Services\Organization\Basic\Employee\EmployeeService;
use App\Http\Requests\Organization\Basic\Employee\EmployeeTranslationRequest;
use App\Services\Organization\HumanResources\EmployeeStaff\EmployeeStaffService;

class EmployeeObserver
{
    protected $employeeService, $language, $userService, $employeeTranslationRequest, $employeeStaffService;

    public function __construct(
        EmployeeService $employeeService,
        Language $language,
        UserService $userService,
        EmployeeStaffService $employeeStaffService,
        EmployeeTranslationRequest $employeeTranslationRequest
    ) {
        $this->language = $language;
        $this->userService = $userService;
        $this->employeeStaffService = $employeeStaffService;
        $this->employeeService = $employeeService;
        $this->employeeTranslationRequest = $employeeTranslationRequest;
    }

    public function created(Employee $employee)
    {
        $user = $this->userService->get()
            ->where('id', $employee->user_id)
            ->whereNotNull('name')
            ->first();
        $data = $this->employeeTranslationRequest->validated();
        if ($user || $data) {
            if ($data) {
                return $this->employeeService->storeTranslation($employee->id, $data['translations']);
            } else {
                $languages = $this->language->get();
                $translations = array();
                foreach ($languages as $key => $language) {
                    $translations[$key]['first_name'] = $user->name;
                    $translations[$key]['language_code'] = $language->code;
                }
                return $this->employeeService->storeTranslation($employee->id, $translations);
            }
        }

    }

    public function updated(Employee $employee)
    {
        $data = $this->employeeTranslationRequest->validated();
        if ($data) {
            $this->employeeService->editTranslation($employee->id, $data['translations']);
        }

        $employee_main_staff = request()->input('employee_main_staff_id');
        if ($employee_main_staff) {
            $employees_staff = $this->employeeStaffService->get()->where('employee_id', $employee->id)->get();
            foreach ($employees_staff as $employee_staff) {
                $employee_staff->id == $employee_main_staff ?
                    $employee_staff_data['is_main_staff'] = 1 :
                    $employee_staff_data['is_main_staff'] = 0;

                $this->employeeStaffService->edit($employee_staff->id, $employee_staff_data);
            }
        }
    }

    public function deleted(Employee $employee)
    {
        //
    }

    public function restored(Employee $employee)
    {
        //
    }

    public function forceDeleted(Employee $employee)
    {
        //
    }
}
