<?php

namespace App\Http\Controllers\Organization\HumanResources;


use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\HumanResources\DepartmentExtraColumn\DepartmentExtraColumnIndexRequest;
use App\Http\Requests\Organization\HumanResources\DepartmentExtraColumn\DepartmentExtraColumnStoreUpdateRequest;
use App\Services\Organization\HumanResources\DepartmentExtraColumn\DepartmentExtraColumnService;

class DepartmentExtraColumnController extends Controller
{
    protected DepartmentExtraColumnService $departmentExtraColumnService;

    public function __construct(DepartmentExtraColumnService $departmentExtraColumnService)
    {
        $this->departmentExtraColumnService = $departmentExtraColumnService;
    }

    public function index(DepartmentExtraColumnIndexRequest $departmentExtraColumnIndexRequest)
    {
        return $this->departmentExtraColumnService->indexDepartmentExtraColumn($departmentExtraColumnIndexRequest->validated());
    }

    public function store(DepartmentExtraColumnStoreUpdateRequest $departmentExtraColumnStoreUpdateRequest)
    {
        return $this->departmentExtraColumnService->store($departmentExtraColumnStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->departmentExtraColumnService->show($id, ['extraColumns']);
    }

    public function update($id, DepartmentExtraColumnStoreUpdateRequest $departmentExtraColumnStoreUpdateRequest)
    {
        return $this->departmentExtraColumnService->edit($id, $departmentExtraColumnStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->departmentExtraColumnService->delete($id);
    }
}
