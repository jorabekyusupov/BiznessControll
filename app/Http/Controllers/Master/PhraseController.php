<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Master\Phrase\PhraseStoreUpdateRequest;
use App\Http\Requests\Master\Phrase\PhraseTranslationRequest;
use App\Services\Master\Phrase\PhraseService;

class PhraseController extends Controller
{
    protected $phraseService;

    public function __construct(PhraseService $phraseService)
    {
        $this->phraseService = $phraseService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->phraseService->indexView($indexRequest->validated());
    }

    public function store(PhraseStoreUpdateRequest $phraseStoreUpdateRequest, PhraseTranslationRequest $phraseTranslationRequest)
    {
        return $this->phraseService->store($phraseStoreUpdateRequest->validated(), $phraseTranslationRequest->validated());
    }

    public function show($id)
    {
        return $this->phraseService->showTranslation($id,'m',['translations']);
    }

    public function getPhrase()
    {
        return $this->phraseService->get(['translations'])->get();
    }

    public function update($id, PhraseStoreUpdateRequest $phraseStoreUpdateRequest, PhraseTranslationRequest $phraseTranslationRequest)
    {
        $data = $phraseStoreUpdateRequest->validated();
        $data['updated_at'] = now();
        return $this->phraseService->edit($id, $data, $phraseTranslationRequest->validated());
    }

    public function global(IndexRequest $indexRequest)
    {
        return $this->phraseService->globalPhrases($indexRequest->validated());
    }

    public function destroy($id)
    {
        return $this->phraseService->softDelete($id);
    }
}
