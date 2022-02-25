<?php

namespace App\Services\Organization\TaskManagement\EmployeeFavoriteTask;

use App\Services\Service;
use App\Repositories\Organization\TaskManagement\EmployeeFavoriteTask\EmployeeFavoriteTaskRepository;

class EmployeeFavoriteTaskService extends Service
{
    public function __construct(EmployeeFavoriteTaskRepository $employeeFavoriteTaskRepository)
    {
        $this->repository = $employeeFavoriteTaskRepository;
    }

}
