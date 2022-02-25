<?php

namespace App\Repositories\Organization\HumanResources\Department;

use App\Models\Organization\HumanResources\Department\Department;
use App\Models\Organization\HumanResources\Department\DepartmentTranslation;
use App\Models\Organization\HumanResources\Department\ViewDepartment;
use App\Repositories\Repository;

class DepartmentRepository extends Repository
{
    public function __construct(
        Department $department,
        DepartmentTranslation $departmentTranslation,
        ViewDepartment $viewDepartment
    )
    {
        $this->model = $department;
        $this->modelTranslation = $departmentTranslation;
        $this->modelView = $viewDepartment;
    }

}
