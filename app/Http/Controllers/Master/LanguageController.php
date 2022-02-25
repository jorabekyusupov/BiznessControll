<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Services\Master\Language\LanguageService;
use App\Http\Requests\Master\Language\LanguageStoreUpdateRequest;

class LanguageController extends Controller
{
    protected  $languageService;

    public function __construct(LanguageService $languageService)
    {
        $this->languageService = $languageService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->languageService->getPaginate($indexRequest->validated());
    }

    public function store(LanguageStoreUpdateRequest $languageStoreUpdateRequest)
    {
        return $this->languageService->store($languageStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->languageService->show($id);
    }

    public function update($id, LanguageStoreUpdateRequest $languageStoreUpdateRequest)
    {
        return $this->languageService->edit($id, $languageStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->languageService->softDelete($id);
    }
}
