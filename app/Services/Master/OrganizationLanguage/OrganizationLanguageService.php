<?php

namespace App\Services\Master\OrganizationLanguage;

use App\Repositories\Master\OrganizationLanguage\OrganizationLanguageRepository;
use App\Services\Service;
use App\Repositories\Master\Organization\OrganizationRepository;

class OrganizationLanguageService extends Service
{
    public function __construct(OrganizationLanguageRepository $organizationLanguageRepository)
    {
        $this->repository = $organizationLanguageRepository;
    }



}
