<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Requests\Organization\TaskManagement\FolderEmployee\FolderEmployeeStoreUpdateRequest;
use App\Services\Organization\TaskManagement\FolderEmployee\FolderEmployeeService;

class FolderEmployeeController extends Controller
{

    private FolderEmployeeService $folderEmployeeService;

    public function __construct(FolderEmployeeService $folderEmployeeService)
    {
        $this->folderEmployeeService = $folderEmployeeService;
    }

    public function store(FolderEmployeeStoreUpdateRequest $folderEmployeeRequest)
    {
        return $this->folderEmployeeService->store($folderEmployeeRequest->validated());

    }

    public function destroy($id)
    {
        return $this->folderEmployeeService->delete($id);
    }

}
