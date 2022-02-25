<?php

namespace App\Repositories\Master\OrganizationModule;

use App\Models\Master\OrganizationModule;
use App\Repositories\Repository;

class OrganizationModuleRepository extends Repository
{
    public function __construct(OrganizationModule $organizationModule)
    {
        $this->model = $organizationModule;
    }

}
