<?php

namespace App\Http\Controllers\Organization\HumanResources;


use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\HumanResources\DepartmentType\DepartmentTypeStoreUpdateRequest;
use App\Http\Requests\TranslationStoreUpdateRequest;
use App\Services\Organization\HumanResources\DepartmentType\DepartmentTypeService;

class DepartmentTypeController extends Controller
{
    protected DepartmentTypeService $departmentTypeService;

    public function __construct(DepartmentTypeService $departmentTypeService)
    {
        $this->departmentTypeService = $departmentTypeService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->departmentTypeService->indexView($indexRequest->validated());
    }

    public function store(DepartmentTypeStoreUpdateRequest $departmentTypeStoreUpdateRequest, TranslationStoreUpdateRequest $translationStoreUpdateRequest)
    {
        return $this->departmentTypeService->store($departmentTypeStoreUpdateRequest->validated(), $translationStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->departmentTypeService->showTranslation($id,'o', ['translations']);
    }

    public function update($id, DepartmentTypeStoreUpdateRequest $departmentTypeStoreUpdateRequest, TranslationStoreUpdateRequest $translationStoreUpdateRequest)
    {
        $data = $departmentTypeStoreUpdateRequest->validated();
        $data['updated_at'] = now();
        return $this->departmentTypeService->edit($id, $data, $translationStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->departmentTypeService->delete($id);
    }
}
