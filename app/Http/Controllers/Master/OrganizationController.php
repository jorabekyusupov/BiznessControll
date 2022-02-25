<?php

namespace App\Http\Controllers\Master;

use App\Http\Requests\IndexRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Master\Organization\OrganizationUpdateRequest;
use App\Services\Master\Organization\OrganizationService;
use App\Http\Requests\Master\Organization\OrganizationStoreUpdateRequest;

class OrganizationController extends Controller
{
    protected $organizationService;

    public function __construct(OrganizationService $organizationService)
    {
        $this->organizationService = $organizationService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->organizationService->getPaginate($indexRequest);
    }

    public function show($id)
    {
        return $this->organizationService->show($id, ['languages', 'languages.languages']);
    }

    public function update($id, OrganizationUpdateRequest $organizationUpdateRequest)
    {
        return $this->organizationService->edit($id, $organizationUpdateRequest->validated());
    }

    public function destroy($id)
    {
        return $this->organizationService->softDelete($id);
    }
}
