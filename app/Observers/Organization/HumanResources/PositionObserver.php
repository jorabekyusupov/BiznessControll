<?php

namespace App\Observers\Organization\HumanResources;

use App\Http\Requests\Organization\HumanResources\Position\PositionTranslationRequest;
use App\Http\Requests\TranslationStoreUpdateRequest;
use App\Models\Organization\HumanResources\Position\Position;
use App\Services\Organization\HumanResources\Position\PositionService;

class PositionObserver
{
    protected PositionService $positionService;
    protected TranslationStoreUpdateRequest $translationStoreUpdateRequest;

    public function __construct(PositionService $positionService, TranslationStoreUpdateRequest $translationStoreUpdateRequest)
    {
        $this->positionService = $positionService;
        $this->translationStoreUpdateRequest = $translationStoreUpdateRequest;
    }

    public function created(Position $position)
    {
        $data = $this->translationStoreUpdateRequest->validated();
        if ($data) {
            return $this->positionService->storeTranslation($position->id, $data['translations']);
        }
    }

    public function updated(Position $position)
    {
        $data = $this->translationStoreUpdateRequest->validated();
        if ($data) {
            return $this->positionService->editTranslation($position->id, $data['translations']);
        }
    }

    public function deleted(Position $orgPosition)
    {
        //
    }

    public function restored(Position $orgPosition)
    {
        //
    }

    public function forceDeleted(Position $orgPosition)
    {
        //
    }
}
