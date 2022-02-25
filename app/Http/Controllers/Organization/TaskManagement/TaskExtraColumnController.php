<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\TaskManagement\TaskExtraColumn\TaskExtraColumnStoreUpdateRequest;
use App\Services\Organization\TaskManagement\TaskExtraColumn\TaskExtraColumnService;
use Illuminate\Http\Request;

class TaskExtraColumnController extends Controller
{
    protected TaskExtraColumnService $taskExtraColumnService;

    public function __construct(TaskExtraColumnService $taskExtraColumnService)
    {
        $this->taskExtraColumnService = $taskExtraColumnService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->taskExtraColumnService->getPaginate($indexRequest->validated(), ['ExtraColumn']);
    }


    public function store(TaskExtraColumnStoreUpdateRequest $taskExtraColumnStoreUpdateRequest)
    {
        return $this->taskExtraColumnService->store($taskExtraColumnStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->taskExtraColumnService->show($id, ['ExtraColumn']);
    }

    public function update($id, TaskExtraColumnStoreUpdateRequest $taskExtraColumnStoreUpdateRequest)
    {
        return $this->taskExtraColumnService->edit($id, $taskExtraColumnStoreUpdateRequest->validated());
    }


    public function destroy($id)
    {
        return $this->taskExtraColumnService->delete($id);
    }
}
