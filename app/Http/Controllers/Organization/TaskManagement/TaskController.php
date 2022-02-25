<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\TaskManagement\Task\TaskIndexRequest;
use App\Http\Requests\Organization\TaskManagement\Task\TaskStoreUpdateRequest;
use App\Services\Organization\TaskManagement\Task\TaskService;
use Carbon\Carbon;

class TaskController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(TaskIndexRequest $taskIndexRequest)
    {
        return $this->taskService->filter($taskIndexRequest->validated(), ['related_employees', 'sub_task']);
    }

    public function store(TaskStoreUpdateRequest $taskStoreUpdateRequest)
    {
        $data = $taskStoreUpdateRequest->validated();
        $data['begin_date'] = new Carbon();
        return $this->taskService->store($data);
    }

    public function show($id)
    {
        return $this->taskService->showTask($id);
    }

    public function update(TaskStoreUpdateRequest $taskStoreUpdateRequest, $id)
    {
        return $this->taskService->edit($id, $taskStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->taskService->delete($id);
    }
}
