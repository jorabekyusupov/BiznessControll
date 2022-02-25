<?php

namespace App\Http\Controllers\Organization\Basic;


use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Basic\EmployeePermission\EmployeePermissionIndexRequest;
use App\Http\Requests\Organization\Basic\EmployeePermission\EmployeePermissionStoreUpdateRequest;
use App\Services\Organization\Basic\EmployeePermission\EmployeePermissionService;

class EmployeePermissionController extends Controller
{
    protected EmployeePermissionService $employeePermissionService;

    public function __construct(EmployeePermissionService $employeePermissionService)
    {
        $this->employeePermissionService = $employeePermissionService;
    }

    public function index(EmployeePermissionIndexRequest $employeePermissionIndexRequest)
    {
        return $this->employeePermissionService->indexEmployeePermission($employeePermissionIndexRequest->validated());
    }

    public function store(EmployeePermissionStoreUpdateRequest $employeePermissionStoreUpdateRequest)
    {
        return $this->employeePermissionService->store($employeePermissionStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->employeePermissionService->show($id);
    }

    public function update($id, EmployeePermissionStoreUpdateRequest $employeePermissionStoreUpdateRequest)
    {
        return $this->employeePermissionService->edit($id, $employeePermissionStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->employeePermissionService->delete($id);
    }
}
