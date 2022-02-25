<?php

namespace App\Http\Controllers\Organization\HumanResources;


use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\HumanResources\EmployeeStaff\EmployeeStaffIndexRequest;
use App\Http\Requests\Organization\HumanResources\EmployeeStaff\EmployeeStaffStoreUpdateRequest;
use App\Services\Organization\HumanResources\EmployeeStaff\EmployeeStaffService;

class EmployeeStaffController extends Controller
{
    protected EmployeeStaffService $employeeStaffService;

    public function __construct(EmployeeStaffService $employeeStaffService)
    {
        $this->employeeStaffService = $employeeStaffService;
    }

    public function index(EmployeeStaffIndexRequest $employeeStaffIndexRequest)
    {
        return $this->employeeStaffService->indexEmployeeStaff($employeeStaffIndexRequest->validated());
    }

    public function store(EmployeeStaffStoreUpdateRequest $employeeStaffStoreUpdateRequest)
    {
        return $this->employeeStaffService->store($employeeStaffStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->employeeStaffService->show($id);
    }

    public function update($id, EmployeeStaffStoreUpdateRequest $employeeStaffStoreUpdateRequest)
    {
        return $this->employeeStaffService->edit($id, $employeeStaffStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->employeeStaffService->softDelete($id);
    }
}
