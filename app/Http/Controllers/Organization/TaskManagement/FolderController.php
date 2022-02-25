<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Services\Organization\TaskManagement\Folder\FolderService;
use App\Http\Requests\Organization\TaskManagement\Folder\FolderStoreUpdateRequest;

class FolderController extends Controller
{
    protected FolderService $folderService;

    public function __construct(FolderService $folderService)
    {
        $this->folderService = $folderService;
    }

    public function index()
    {
        return $this->folderService->get()->whereNull('parent_id')->with('children')->get();
    }


    public function store(FolderStoreUpdateRequest $folderStoreUpdateRequest)
    {
        return $this->folderService->store($folderStoreUpdateRequest->validated());
    }


    public function show($id)
    {
        return $this->folderService->show($id);
    }


    public function update($id, FolderStoreUpdateRequest $folderStoreUpdateRequest)
    {
        return $this->folderService->edit($id, $folderStoreUpdateRequest->validated());
    }

    public function folderPath($id)
    {
        return $this->folderService->treePath($id, 1, []);
    }

    public function destroy($id)
    {
        return $this->folderService->softDelete($id);
    }
}
