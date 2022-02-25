<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\TaskManagement\TaskTag\TaskTagStoreUpdateRequest;
use App\Services\Organization\TaskManagement\TaskTag\TaskTagService;
use Illuminate\Http\Request;

class TaskTagController extends Controller
{

    protected TaskTagService $taskTagService;

    public function __construct(TaskTagService $taskTagService)
    {
        $this->taskTagService = $taskTagService;
    }

    public function store(TaskTagStoreUpdateRequest $tagStoreUpdateRequest)
    {
        return $this->taskTagService->store($tagStoreUpdateRequest->validated());
    }


    public function show($id)
    {
        return $this->taskTagService->show($id);
    }


    public function update(TaskTagStoreUpdateRequest $tagStoreUpdateRequest, $id)
    {
        return $this->taskTagService->edit($id, $tagStoreUpdateRequest->validated());
    }


    public function destroy($id)
    {
        //
    }
}
