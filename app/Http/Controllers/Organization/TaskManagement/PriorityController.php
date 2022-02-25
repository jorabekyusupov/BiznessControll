<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\TaskManagement\Priority\PriorityStoreUpdateRequest;
use App\Services\Organization\TaskManagement\Priority\PriorityService;
use Illuminate\Http\Request;

class PriorityController extends Controller
{
    protected PriorityService $priorityService;

    public function __construct(PriorityService $priorityService)
    {
        $this->priorityService = $priorityService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->priorityService->getPaginate($indexRequest);
    }


    public function store(PriorityStoreUpdateRequest $priorityStoreUpdateRequest)
    {
        return $this->priorityService->store($priorityStoreUpdateRequest->validated());
    }


    public function show($id)
    {
        return $this->priorityService->show($id);
    }


    public function update($id,PriorityStoreUpdateRequest $priorityStoreUpdateRequest)
    {
        return $this->priorityService->edit($id, $priorityStoreUpdateRequest->validated());
    }


    public function destroy($id)
    {
        return $this->priorityService->delete($id);
    }
}
