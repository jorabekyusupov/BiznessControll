<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Master\Module\ModuleStoreUpdateRequest;
use App\Services\Master\Module\ModuleService;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->moduleService->getPaginate($indexRequest->validated());
    }

    public function store(ModuleStoreUpdateRequest $moduleStoreUpdateRequest)
    {
        return $this->moduleService->store($moduleStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->moduleService->show($id);
    }

    public function update($id, ModuleStoreUpdateRequest $moduleStoreUpdateRequest)
    {
        return $this->moduleService->edit($id, $moduleStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->moduleService->softDelete($id);
    }
}
