<?php

namespace App\Repositories\Organization\TaskManagement\EmployeeFavoriteTask;
use App\Models\Organization\TaskManagement\EmployeeFavoriteTask\EmployeeFavoriteTask;
use App\Repositories\Repository;


class EmployeeFavoriteTaskRepository extends Repository
{
    public function __construct(EmployeeFavoriteTask $employeeFavoriteTask)
    {
        $this->model = $employeeFavoriteTask;
    }

}
