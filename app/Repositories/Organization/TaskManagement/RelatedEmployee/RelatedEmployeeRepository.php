<?php

namespace App\Repositories\Organization\TaskManagement\RelatedEmployee;

use App\Models\Organization\TaskManagement\RelatedEmployee\RelatedEmployee;
use App\Models\Organization\TaskManagement\RelatedEmployee\ViewEmployeeTask;
use App\Repositories\Repository;

class RelatedEmployeeRepository extends Repository
{
    public function __construct(
        RelatedEmployee $relatedEmployee,
        ViewEmployeeTask $viewEmployeeTask
    )
    {
        $this->model = $relatedEmployee;
        $this->modelView = $viewEmployeeTask;
    }

}
