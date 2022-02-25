<?php

namespace App\Services\Organization\TaskManagement\RelatedEmployee;

use App\Repositories\Organization\TaskManagement\RelatedEmployee\RelatedEmployeeRepository;
use App\Services\Service;

class RelatedEmployeeService extends Service
{
    public function __construct(RelatedEmployeeRepository $relatedEmployeeRepository)
    {
        $this->repository = $relatedEmployeeRepository;
    }
}
