<?php

namespace App\Repositories\Organization\HumanResources\DepartmentExtraColumn;

use App\Models\Organization\HumanResources\DepartmentExtraColumn\DepartmentExtraColumn;
use App\Repositories\Repository;

class DepartmentExtraColumnRepository extends Repository
{
    public function __construct(DepartmentExtraColumn $departmentExtraColumn)
    {
        $this->model = $departmentExtraColumn;
    }
}
