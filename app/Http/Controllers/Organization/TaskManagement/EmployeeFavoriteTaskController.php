<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\TaskManagement\EmployeeFavoriteTask\EmployeeFavoriteTaskStoreUpdateRequest;
use App\Services\Organization\TaskManagement\EmployeeFavoriteTask\EmployeeFavoriteTaskService;
use Illuminate\Http\Request;

class EmployeeFavoriteTaskController extends Controller
{
    protected EmployeeFavoriteTaskService $employeeFavoriteTaskService;

    public function __construct(EmployeeFavoriteTaskService $employeeFavoriteTaskService)
    {
        $this->employeeFavoriteTaskService = $employeeFavoriteTaskService;
    }

    public function store(EmployeeFavoriteTaskStoreUpdateRequest $employeeFavoriteTaskStoreUpdateRequest)
    {
        return $this->employeeFavoriteTaskService->store($employeeFavoriteTaskStoreUpdateRequest->validated());
    }


    public function show($id)
    {
        return $this->employeeFavoriteTaskService->show($id);
    }


    public function update($id, EmployeeFavoriteTaskStoreUpdateRequest $employeeFavoriteTaskStoreUpdateRequest)
    {
        return $this->employeeFavoriteTaskService->edit($id, $employeeFavoriteTaskStoreUpdateRequest->validated());
    }


    public function destroy($id)
    {
        return $this->employeeFavoriteTaskService->delete($id);
    }
}
