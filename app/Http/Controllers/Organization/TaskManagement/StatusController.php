<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\TaskManagement\Status\StatusStoreUpdateRequest;
use App\Services\Organization\TaskManagement\Status\StatusService;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    protected StatusService $statusService;

    public function __construct(StatusService $statusService)
    {
        $this->statusService = $statusService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->statusService->indexStatus($indexRequest->validated());
    }

    public function store(StatusStoreUpdateRequest $statusStoreUpdateRequest)
    {
        return $this->statusService->store($statusStoreUpdateRequest->validated());
    }


    public function show($id)
    {
        return $this->statusService->show($id);
    }


    public function update(StatusStoreUpdateRequest $statusStoreUpdateRequest, $id)
    {
        return $this->statusService->edit($id, $statusStoreUpdateRequest->validated());
    }


    public function destroy($id)
    {
        return $this->statusService->delete($id);
    }
}
