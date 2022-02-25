<?php

namespace App\Observers\Organization\HumanResources;

use App\Http\Requests\Organization\HumanResources\Department\DepartmentTranslationRequest;
use App\Http\Requests\TranslationStoreUpdateRequest;
use App\Models\Organization\HumanResources\Department\Department;
use App\Services\Organization\HumanResources\Department\DepartmentService;

class DepartmentObserver
{
    protected DepartmentService $departmentService;
    protected TranslationStoreUpdateRequest $translationStoreUpdateRequest;


    public function __construct(
        DepartmentService $departmentService,
        TranslationStoreUpdateRequest $translationStoreUpdateRequest
    ) {
        $this->departmentService = $departmentService;
        $this->translationStoreUpdateRequest = $translationStoreUpdateRequest;
    }

    public function created(Department $department)
    {
        $data = $this->translationStoreUpdateRequest->validated();
        if ($data) {
            return $this->departmentService->storeTranslation($department->id, $data['translations']);
        }
    }

    public function updated(Department $department)
    {
        $data = $this->translationStoreUpdateRequest->validated();
        if ($data){
            return $this->departmentService->editTranslation($department->id, $data['translations']);
        }
    }

    public function deleted(Department $department)
    {
        //
    }

    public function restored(Department $department)
    {
        //
    }

    public function forceDeleted(Department $department)
    {
        //
    }
}
