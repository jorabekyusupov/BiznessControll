<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\TaskManagement\Tag\TagStoreUpdateRequest;
use App\Services\Organization\TaskManagement\Tag\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{

    protected TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->tagService->getPaginate($indexRequest->validated());
    }


    public function store(TagStoreUpdateRequest $tagStoreUpdateRequest)
    {
        return $this->tagService->store($tagStoreUpdateRequest->validated());
    }


    public function show($id)
    {
        return $this->tagService->show($id);
    }


    public function update(TagStoreUpdateRequest $tagStoreUpdateRequest, $id)
    {
        return $this->tagService->edit($id, $tagStoreUpdateRequest->validated());
    }


    public function destroy($id)
    {
        return $this->tagService->delete($id);
    }
}
