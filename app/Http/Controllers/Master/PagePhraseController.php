<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\PagePhrase\PagePhraseIndexRequest;
use App\Http\Requests\Master\PagePhrase\PagePhraseStoreUpdateRequest;
use App\Services\Master\PagePhrase\PagePhraseService;

class PagePhraseController extends Controller
{
    protected PagePhraseService $pagePhraseService;

    public function __construct(PagePhraseService $pagePhraseService)
    {
        $this->pagePhraseService = $pagePhraseService;
    }

    public function index(PagePhraseIndexRequest $pagePhraseIndexRequest)
    {
        return $this->pagePhraseService->indexPagePhrase($pagePhraseIndexRequest->validated());
    }

    public function store(PagePhraseStoreUpdateRequest $pagePhraseStoreUpdateRequest)
    {
        return $this->pagePhraseService->store($pagePhraseStoreUpdateRequest->validated());
    }

    public function update($id, PagePhraseStoreUpdateRequest $pagePhraseStoreUpdateRequest)
    {
        return $this->pagePhraseService->edit($id, $pagePhraseStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->pagePhraseService->delete($id);
    }
}
