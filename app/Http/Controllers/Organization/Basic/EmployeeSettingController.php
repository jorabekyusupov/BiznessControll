<?php

namespace App\Http\Controllers\Organization\Basic;


use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Basic\EmployeeSetting\EmployeeSettingStoreUpdateRequest;
use App\Services\Organization\Basic\EmployeeSetting\EmployeeSettingService;

class EmployeeSettingController extends Controller
{
    protected EmployeeSettingService $employeeSettingService;

    public function __construct(EmployeeSettingService $employeeSettingService)
    {
        $this->employeeSettingService = $employeeSettingService;
    }

    public function store(EmployeeSettingStoreUpdateRequest $employeeSettingStoreUpdateRequest)
    {
        return $this->employeeSettingService->store($employeeSettingStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->employeeSettingService->show($id);
    }

    public function update($id, EmployeeSettingStoreUpdateRequest $employeeSettingStoreUpdateRequest)
    {
        return $this->employeeSettingService->edit($id, $employeeSettingStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->employeeSettingService->delete($id);
    }
}
