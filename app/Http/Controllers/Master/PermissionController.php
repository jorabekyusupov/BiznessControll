<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Master\Permission\PermissionStoreUpdateRequest;
use App\Services\Master\Permission\PermissionService;

class PermissionController extends Controller
{
    protected PermissionService $permissionService;

    public function __construct(PermissionService $permissionService)
    {
        $this->permissionService = $permissionService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->permissionService->getPaginate($indexRequest->validated());
    }
    public function store(PermissionStoreUpdateRequest $permissionStoreUpdateRequest)
    {
        return $this->permissionService->store($permissionStoreUpdateRequest->validated());
    }

    public function update($id, PermissionStoreUpdateRequest $permissionStoreUpdateRequest)
    {
        return $this->permissionService->edit($id, $permissionStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->permissionService->show($id);
    }

    public function destroy($id)
    {
        return $this->permissionService->delete($id);
    }
}
