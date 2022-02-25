<?php

namespace App\Services\Organization\Basic\Module;

use App\Repositories\Organization\Basic\Module\ModuleRepository;
use App\Services\Service;

class ModuleService extends Service
{
    public function __construct(ModuleRepository $moduleRepository)
    {
        $this->repository = $moduleRepository;
    }

}
