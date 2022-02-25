<?php

namespace App\Http\Controllers\Organization\Basic;


use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\Basic\ExtraColumn\ExtraColumnRequest;
use App\Http\Requests\TranslationStoreUpdateRequest;
use App\Services\Organization\Basic\ExtraColumn\ExtraColumnService;

class ExtraColumnController extends Controller
{
    protected ExtraColumnService $extraColumnService;

    public function __construct(ExtraColumnService $extraColumnService)
    {
        $this->extraColumnService = $extraColumnService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->extraColumnService->indexView($indexRequest->validated());
    }

    public function store(ExtraColumnRequest $extraColumnRequest, TranslationStoreUpdateRequest $translationStoreUpdateRequest)
    {
        return $this->extraColumnService->store($extraColumnRequest->validated(), $translationStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->extraColumnService->showTranslation($id, 'o', ['translations']);
    }

    public function update($id, ExtraColumnRequest $extraColumnRequest, TranslationStoreUpdateRequest $translationStoreUpdateRequest)
    {
        $data = $extraColumnRequest->validated();
        $data['updated_at'] = now();
        return $this->extraColumnService->edit($id, $data, $translationStoreUpdateRequest->validated());
    }


    public function destroy($id)
    {
        return $this->extraColumnService->deleteExtraColumn($id);
    }
}
