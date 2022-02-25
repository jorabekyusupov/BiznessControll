<?php

namespace App\Http\Controllers\Organization\HumanResources;


use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\HumanResources\Staff\StaffStoreUpdateRequest;
use App\Services\Organization\HumanResources\EmployeeStaff\EmployeeStaffService;
use App\Services\Organization\HumanResources\Staff\StaffService;

class StaffController extends Controller
{
    protected StaffService $staffService;

    public function __construct(StaffService $staffService )
    {
        $this->staffService = $staffService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->staffService->indexStaff($indexRequest->validated());
    }

    public function store(StaffStoreUpdateRequest $staffStoreUpdateRequest)
    {
        return $this->staffService->storeStaff($staffStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->staffService->show($id);
    }

    public function update($id, StaffStoreUpdateRequest $staffStoreUpdateRequest)
    {
        return $this->staffService->updateStaff($id, $staffStoreUpdateRequest->validated());
    }


    public function destroy($id)
    {
        return $this->staffService->deleteStaff($id);
    }
}
