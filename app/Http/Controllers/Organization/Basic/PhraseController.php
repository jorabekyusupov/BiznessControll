<?php

namespace App\Http\Controllers\Organization\Basic;

use App\Http\Requests\IndexRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\Basic\Phrase\PhraseTranslationRequest;
use App\Services\Organization\Basic\Phrase\PhraseService;
use App\Http\Requests\Organization\Basic\Phrase\PhraseTranslateRequest;
use App\Http\Requests\Organization\Basic\Phrase\PhraseStoreUpdateRequest;

class PhraseController extends Controller
{
    protected PhraseService $phraseService;

    public function __construct(PhraseService $phraseService)
    {
        $this->phraseService = $phraseService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->phraseService->indexView($indexRequest->validated());
    }

    public function list(IndexRequest $indexRequest)
    {
        return $this->phraseService->listPhrase($indexRequest->validated());
    }

    public function store(PhraseStoreUpdateRequest $phraseStoreUpdateRequest, PhraseTranslationRequest $phraseTranslateRequest)
    {
        return $this->phraseService->store($phraseStoreUpdateRequest->validated(), $phraseTranslateRequest->validated());
    }

    public function show($id)
    {
       return $this->phraseService->showTranslation($id,'o',['translations']);
    }

    public function update($id, PhraseStoreUpdateRequest $phraseStoreUpdateRequest, PhraseTranslationRequest $phraseTranslateRequest)
    {
        $data=$phraseStoreUpdateRequest->validated();
        $data['updated_at']=now();
        return $this->phraseService->edit($id, $data, $phraseTranslateRequest->validated());
    }

    public function translate(PhraseTranslateRequest $phraseTranslateRequest)
    {
        return $this->phraseService->translate($phraseTranslateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->phraseService->softDelete($id);
    }
}
