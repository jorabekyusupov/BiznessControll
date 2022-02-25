<?php

namespace App\Http\Controllers\Master;

use App\Http\Controllers\Controller;
use App\Http\Requests\Master\OrganizationLanguage\OrganizationLanguageStoreUpdateRequest;
use App\Services\Master\OrganizationLanguage\OrganizationLanguageService;

class OrganizationLanguageController extends Controller
{
    protected OrganizationLanguageService $organizationLanguageService;

    public function __construct(OrganizationLanguageService $organizationLanguageService)
    {
        $this->organizationLanguageService = $organizationLanguageService;
    }

    public function store(OrganizationLanguageStoreUpdateRequest $organizationLanguageStoreUpdateRequest)
    {
        return $this->organizationLanguageService->store($organizationLanguageStoreUpdateRequest->validated());
    }

    public function update($id, OrganizationLanguageStoreUpdateRequest $organizationLanguageStoreUpdateRequest)
    {
        return $this->organizationLanguageService->edit($id, $organizationLanguageStoreUpdateRequest->validated());
    }

    public function show($id)
    {
        return $this->organizationLanguageService->show($id, ['languages']);
    }

    public function destroy($id)
    {
        return $this->organizationLanguageService->delete($id);
    }
}
