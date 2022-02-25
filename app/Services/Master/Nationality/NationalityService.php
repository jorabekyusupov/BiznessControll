<?php

namespace App\Services\Master\Nationality;

use App\Repositories\Master\Nationality\NationalityRepository;
use App\Services\Service;

class NationalityService extends Service
{
    public function __construct(NationalityRepository $nationalityRepository)
    {
        $this->repository = $nationalityRepository;
    }

}
