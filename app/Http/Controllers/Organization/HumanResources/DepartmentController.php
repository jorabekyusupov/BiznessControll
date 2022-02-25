<?php

namespace App\Http\Controllers\Organization\HumanResources;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\HumanResources\Department\DepartmentStoreUpdateRequest;
use App\Http\Requests\TranslationStoreUpdateRequest;
use App\Http\Resources\Organization\HumanResources\DepartmentResource;
use App\Services\Organization\HumanResources\Department\DepartmentService;

class DepartmentController extends Controller
{
    protected DepartmentService $departmentService;

    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return DepartmentResource::collection($this->departmentService->indexView($indexRequest->validated()));
    }

    public function treeDepartment()
    {
        return $this->departmentService->getDepartmentTree(null);
    }

    public function store(DepartmentStoreUpdateRequest $departmentStoreUpdateRequest, TranslationStoreUpdateRequest $translationStoreUpdateRequest)
    {
        return $this->departmentService->store($departmentStoreUpdateRequest->validated(), $translationStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->departmentService->showDepartment($id, ['translations', 'extraColumns']);
    }

    public function update($id, DepartmentStoreUpdateRequest $departmentStoreUpdateRequest, TranslationStoreUpdateRequest $translationStoreUpdateRequest)
    {
        $data = $departmentStoreUpdateRequest->validated();
        $data['updated_at'] = now();
        return $this->departmentService->edit($id, $data, $translationStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->departmentService->softDelete($id);
    }
}
