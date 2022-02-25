<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\TaskManagement\RelatedEmployee\RelatedEmployeeStoreUpdateRequest;
use App\Services\Organization\TaskManagement\RelatedEmployee\RelatedEmployeeService;
use App\Services\Organization\TaskManagement\Task\TaskService;

class RelatedEmployeeController extends Controller
{
    protected RelatedEmployeeService $relatedEmployeeService;
    protected TaskService $taskService;

    public function __construct(RelatedEmployeeService $relatedEmployeeService, TaskService $taskService)
    {
        $this->relatedEmployeeService = $relatedEmployeeService;
        $this->taskService = $taskService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->relatedEmployeeService->getPaginate($indexRequest->validated());
    }


    public function store(RelatedEmployeeStoreUpdateRequest $relatedEmployeeStoreUpdateRequest)
    {
        return $this->relatedEmployeeService->store($relatedEmployeeStoreUpdateRequest->validated());
    }


    public function show($id)
    {
        return $this->relatedEmployeeService->show($id);
    }


    public function update($id, RelatedEmployeeStoreUpdateRequest $relatedEmployeeStoreUpdateRequest)
    {
        $related_employee = $this->relatedEmployeeService->edit($id, $relatedEmployeeStoreUpdateRequest->validated())->getData();
        if ($related_employee == 'Not found')
            return response('Not found', 404);
        $expected_duration = $this->relatedEmployeeService->get()->where('task_id', $related_employee->task_id)->sum('expected_duration');
        $actual_duration = $this->relatedEmployeeService->get()->where('task_id', $related_employee->task_id)->sum('actual_duration');
        $this->taskService->edit($related_employee->task_id, ['expected_duration' => $expected_duration, 'actual_duration' => $actual_duration]);

        return $related_employee;
    }


    public function destroy($id)
    {
        return $this->relatedEmployeeService->delete($id);
    }
}
