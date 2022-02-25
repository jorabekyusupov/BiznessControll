<?php

namespace App\Observers\Organization\HumanResources;

use App\Http\Requests\Organization\HumanResources\DepartmentType\DepartmentTypeTranslationRequest;
use App\Http\Requests\TranslationStoreUpdateRequest;
use App\Models\Organization\HumanResources\DepartmentType\DepartmentType;
use App\Services\Organization\HumanResources\DepartmentType\DepartmentTypeService;

class DepartmentTypeObserver
{
    protected DepartmentTypeService $departmentTypeService;
    protected TranslationStoreUpdateRequest $translationStoreUpdateRequest;


    public function __construct(
        DepartmentTypeService $departmentTypeService,
        TranslationStoreUpdateRequest $translationStoreUpdateRequest
    ) {
        $this->departmentTypeService = $departmentTypeService;
        $this->translationStoreUpdateRequest = $translationStoreUpdateRequest;
    }

    public function created(DepartmentType $departmentType)
    {
        $data = $this->translationStoreUpdateRequest->validated();
        if ($data) {
            return $this->departmentTypeService->storeTranslation($departmentType->id, $data['translations']);

        }
    }

    public function updated(DepartmentType $departmentType)
    {
        $data = $this->translationStoreUpdateRequest->validated();
        if ($data) {
            return $this->departmentTypeService->editTranslation($departmentType->id, $data['translations']);
        }

    }

    public function deleted(DepartmentType $departmentType)
    {
        //
    }

    public function restored(DepartmentType $departmentType)
    {
        //
    }

    public function forceDeleted(DepartmentType $departmentType)
    {
        //
    }
}
