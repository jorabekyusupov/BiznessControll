<?php

namespace App\Services\Master\Module;

use App\Repositories\Master\Module\ModuleRepository;
use App\Services\Service;

class ModuleService extends Service
{
    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->repository = $moduleRepository;
    }

}
