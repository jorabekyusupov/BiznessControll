<?php

namespace App\Repositories\Master\UserOrganization;

use App\Models\Master\UserOrganization;
use App\Repositories\Repository;

class UserOrganizationRepository extends Repository
{
    public function __construct(UserOrganization $userOrganization)
    {
        $this->model = $userOrganization;
    }

}
