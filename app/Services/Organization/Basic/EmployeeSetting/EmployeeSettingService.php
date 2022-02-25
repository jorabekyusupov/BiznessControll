<?php

namespace App\Services\Organization\Basic\EmployeeSetting;

use App\Repositories\Organization\Basic\EmployeeSetting\EmployeeSettingRepository;
use App\Services\Service;

class EmployeeSettingService extends Service
{
    public function __construct(EmployeeSettingRepository $employeeSettingRepository)
    {
        $this->repository = $employeeSettingRepository;
    }

}
