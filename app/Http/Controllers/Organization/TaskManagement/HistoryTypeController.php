<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\TaskManagement\HistoryType\HistoryTypeStoreUpdateRequest;
use App\Services\Organization\TaskManagement\History\HistoryTypeService;

class HistoryTypeController extends Controller
{

    protected HistoryTypeService $historyTypeService;

    public function __construct(HistoryTypeService $historyTypeService)
    {
        $this->historyTypeService = $historyTypeService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->historyTypeService->getPaginate($indexRequest->validated());
    }


    public function store(HistoryTypeStoreUpdateRequest $historyTypeStoreUpdateRequest)
    {
        return $this->historyTypeService->store($historyTypeStoreUpdateRequest->validated());
    }


    public function show($id)
    {
        return $this->historyTypeService->show($id);
    }


    public function update($id, HistoryTypeStoreUpdateRequest $historyTypeStoreUpdateRequest)
    {
        return $this->historyTypeService->edit($id, $historyTypeStoreUpdateRequest->validated());
    }


    public function destroy($id)
    {
        return $this->historyTypeService->delete($id);
    }
}
