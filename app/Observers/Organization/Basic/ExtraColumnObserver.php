<?php

namespace App\Observers\Organization\Basic;

use App\Http\Requests\TranslationStoreUpdateRequest;
use App\Models\Organization\Basic\ExtraColumn\ExtraColumn;
use App\Repositories\Organization\HumanResources\DepartmentExtraColumn\DepartmentExtraColumnRepository;
use App\Repositories\Organization\Basic\ExtraColumn\ExtraColumnRepository;
use App\Services\Organization\Basic\ExtraColumn\ExtraColumnService;

class ExtraColumnObserver
{
    protected ExtraColumnService $extraColumnService;
    protected TranslationStoreUpdateRequest $translationStoreUpdateRequest;
    protected DepartmentExtraColumnRepository $departmentExtraColumnRepository;
    protected ExtraColumnRepository $extraColumnRepository;

    public function __construct(
        ExtraColumnService              $extraColumnService,
        ExtraColumnRepository           $extraColumnRepository,
        DepartmentExtraColumnRepository $departmentExtraColumnRepository,
        TranslationStoreUpdateRequest $translationStoreUpdateRequest
    )
    {
        $this->extraColumnService = $extraColumnService;
        $this->departmentExtraColumnRepository = $departmentExtraColumnRepository;
        $this->extraColumnRepository = $extraColumnRepository;
        $this->translationStoreUpdateRequest = $translationStoreUpdateRequest;
    }

    public function created(ExtraColumn $extraColumn)
    {
        $data = $this->translationStoreUpdateRequest->validated();
        if ($data) {
            return $this->extraColumnService->storeTranslation($extraColumn->id, $data['translations']);
        }
    }

    public function updated(ExtraColumn $extraColumn)
    {
        $data = $this->translationStoreUpdateRequest->validated();
        if ($data) {
            return $this->extraColumnService->editTranslation($extraColumn->id, $data['translations']);
        }
    }

    public function deleted(ExtraColumn $extraColumn)
    {
//        $this->departmentExtraColumnRepository->query()
//            ->where('extra_column_id', $extraColumn->id)->delete();
//
//        $this->extraColumnRepository->modelTranslation->query()
//            ->where('object_id', $extraColumn->id)->delete();
    }

    public function restored(ExtraColumn $extraColumn)
    {
        //
    }

    public function forceDeleted(ExtraColumn $extraColumn)
    {
        //
    }
}
