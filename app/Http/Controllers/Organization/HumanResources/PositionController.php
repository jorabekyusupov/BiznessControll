<?php

namespace App\Http\Controllers\Organization\HumanResources;


use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\HumanResources\Position\PositionStoreUpdateRequest;
use App\Http\Requests\TranslationStoreUpdateRequest;
use App\Services\Organization\HumanResources\Position\PositionService;

class PositionController extends Controller
{
    protected PositionService $positionService;

    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->positionService->indexView($indexRequest->validated());
    }

    public function store(PositionStoreUpdateRequest $positionStoreUpdateRequest, TranslationStoreUpdateRequest $translationStoreUpdateRequest)
    {
        return $this->positionService->store($positionStoreUpdateRequest->validated(), $translationStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->positionService->showTranslation($id, 'o',['translations']);
    }

    public function update($id, PositionStoreUpdateRequest $positionStoreUpdateRequest, TranslationStoreUpdateRequest $translationStoreUpdateRequest)
    {
        $data = $positionStoreUpdateRequest->validated();
        $data['updated_at'] = now();
        return $this->positionService->edit($id, $data, $translationStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->positionService->softDelete($id);
    }
}
