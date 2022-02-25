<?php

namespace App\Repositories\Master\OrganizationLanguage;

use App\Models\Master\OrganizationLanguage;
use App\Repositories\Repository;

class OrganizationLanguageRepository extends Repository
{
    public function __construct(OrganizationLanguage $organizationLanguage)
    {
        $this->model = $organizationLanguage;
    }

}
