<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\TaskManagement\History\HistoryStoreUpdateRequest;
use App\Http\Resources\Organization\TaskManagement\HistoryResource;
use App\Services\Organization\TaskManagement\History\HistoryService;

class HistoryController extends Controller
{

    protected HistoryService $historyService;

    public $rel = [
        'parent_new',
        'parent_old',
        'related_employee_new',
        'related_employee_old',
        'status_new',
        'status_old',
//        'employee_status_new',
//        'employee_status_old',
        'folder_new',
        'folder_old',
        'priority_new',
        'priority_old',
        'task_type_old',
        'task_type_new'
    ];

    public function __construct(HistoryService $historyService)
    {
        $this->historyService = $historyService;
    }

    public function index()
    {
        return HistoryResource::collection($this->historyService->list(request()->only('task_id'), $this->rel));
    }

    public function store(HistoryStoreUpdateRequest $historyStoreUpdateRequest)
    {
        return $this->historyService->store($historyStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->historyService->show($id);
    }

    public function update($id, HistoryStoreUpdateRequest $historyStoreUpdateRequest)
    {
        return $this->historyService->edit($id, $historyStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->historyService->delete($id);
    }
}
