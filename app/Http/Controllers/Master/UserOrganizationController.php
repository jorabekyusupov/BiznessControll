<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\UserOrganization\UserOrganizationIndexRequest;
use App\Http\Requests\Master\UserOrganization\UserOrganizationStoreUpdateRequest;
use App\Services\Master\UserOrganization\UserOrganizationService;

class UserOrganizationController extends Controller
{
    protected UserOrganizationService $userOrganizationService;

    public function __construct(UserOrganizationService $userOrganizationService)
    {
        $this->userOrganizationService = $userOrganizationService;
    }

    public function index(UserOrganizationIndexRequest $userOrganizationIndexRequest)
    {
        return $this->userOrganizationService->indexUserOrganization($userOrganizationIndexRequest->validated());
    }

    public function store(UserOrganizationStoreUpdateRequest $userOrganizationStoreUpdateRequest)
    {
        return $this->userOrganizationService->store($userOrganizationStoreUpdateRequest->validated());
    }

    public function update($id, UserOrganizationStoreUpdateRequest $userOrganizationStoreUpdateRequest)
    {
        return $this->userOrganizationService->edit($id, $userOrganizationStoreUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->userOrganizationService->delete($id);
    }
}
