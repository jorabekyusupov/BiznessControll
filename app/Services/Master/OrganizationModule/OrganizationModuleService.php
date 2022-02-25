<?php

namespace App\Services\Master\OrganizationModule;

use App\Services\Service;
use App\Repositories\Master\OrganizationModule\OrganizationModuleRepository;

class OrganizationModuleService extends Service
{
    public function __construct(OrganizationModuleRepository $organizationModuleRepository)
    {
        $this->repository = $organizationModuleRepository;
    }

    public function indexOrganizationModule($data)
    {
        $organization_id = $data['organization_id'] ?? null;
        if ($organization_id) return $this->get()->where('organization_id', $organization_id)->get();
        else return $this->getPaginate($data);
    }
}
