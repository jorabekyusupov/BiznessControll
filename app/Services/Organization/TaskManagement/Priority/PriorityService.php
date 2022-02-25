<?php

namespace App\Services\Organization\TaskManagement\Priority;

use App\Repositories\Organization\TaskManagement\Priority\PriorityRepository;
use App\Services\Service;

class PriorityService extends Service
{
    public function __construct(PriorityRepository $priorityRepository)
    {
        $this->repository = $priorityRepository;
    }
}
