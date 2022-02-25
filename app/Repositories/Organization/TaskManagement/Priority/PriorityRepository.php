<?php

namespace App\Repositories\Organization\TaskManagement\Priority;


use App\Models\Organization\TaskManagement\Priority\Priority;
use App\Models\Organization\TaskManagement\Priority\PriorityTranslation;
use App\Repositories\Repository;

class PriorityRepository extends Repository
{
    public function __construct(Priority $priority)
    {
        $this->model = $priority;
    }
}
