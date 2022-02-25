<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\Page\PageIndexRequest;
use App\Http\Requests\Master\Page\PageStoreUpdateRequest;
use App\Services\Master\Page\PageService;

class PageController extends Controller
{
    protected PageService $pageService;

    public function __construct(PageService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function index(PageIndexRequest $pageIndexRequest)
    {
        return $this->pageService->indexPage($pageIndexRequest->validated(), ['module']);
    }

    public function store(PageStoreUpdateRequest $pageStoreUpdateRequest)
    {
        return $this->pageService->store($pageStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->pageService->show($id);
    }

    public function update($id, PageStoreUpdateRequest $pageStoreUpdateRequest)
    {
        return $this->pageService->edit($id, $pageStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->pageService->softDelete($id);
    }
}
