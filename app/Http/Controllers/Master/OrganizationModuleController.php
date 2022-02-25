<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\OrganizationModule\OrganizationModuleIndexRequest;
use App\Http\Requests\Master\OrganizationModule\OrganizationModuleStoreUpdateRequest;
use App\Services\Master\OrganizationModule\OrganizationModuleService;

class OrganizationModuleController extends Controller
{
    protected OrganizationModuleService $organizationModuleService;

    public function __construct(OrganizationModuleService $organizationModuleService)
    {
        return $this->organizationModuleService = $organizationModuleService;
    }

    public function index(OrganizationModuleIndexRequest $organizationModuleIndexRequest)
    {
        return $this->organizationModuleService->indexOrganizationModule($organizationModuleIndexRequest->validated());
    }

    public function store(OrganizationModuleStoreUpdateRequest $organizationModuleStoreUpdateRequest)
    {
        return $this->organizationModuleService->store($organizationModuleStoreUpdateRequest->validated());
    }

    public function update($id, OrganizationModuleStoreUpdateRequest $organizationModuleStoreUpdateRequest)
    {
        return $this->organizationModuleService->edit($id, $organizationModuleStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->organizationModuleService->delete($id);
    }
}
