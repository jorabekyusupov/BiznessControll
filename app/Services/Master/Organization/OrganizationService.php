<?php

namespace App\Services\Master\Organization;

use App\Services\Service;
use App\Repositories\Master\Organization\OrganizationRepository;

class OrganizationService extends Service
{
    public function __construct(OrganizationRepository $organizationRepository)
    {
        $this->repository = $organizationRepository;
    }

}
