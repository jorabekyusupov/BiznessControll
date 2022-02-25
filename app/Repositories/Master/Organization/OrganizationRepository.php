<?php

namespace App\Repositories\Master\Organization;

use App\Models\Master\Organization;
use App\Repositories\Repository;

class OrganizationRepository extends Repository
{
    public function __construct(Organization $organization)
    {
        $this->model = $organization;
    }

}
