<?php

namespace App\Repositories\Organization\Basic\EmployeeSetting;

use App\Models\Organization\Basic\EmployeeSetting\EmployeeSetting;
use App\Repositories\Repository;

class EmployeeSettingRepository extends Repository
{
    public function __construct(EmployeeSetting $employeeSetting)
    {
        $this->model = $employeeSetting;
    }

}
