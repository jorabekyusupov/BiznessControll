<?php
namespace App\Repositories\Organization\HumanResources\DepartmentType;

use App\Models\Organization\HumanResources\DepartmentType\DepartmentType;
use App\Models\Organization\HumanResources\DepartmentType\DepartmentTypeTranslation;
use App\Models\Organization\HumanResources\DepartmentType\ViewDepartmentType;
use App\Repositories\Repository;

class DepartmentTypeRepository extends Repository{

    public function __construct(DepartmentType $departmentType, DepartmentTypeTranslation $departmentTypeTranslation, ViewDepartmentType $viewDepartmentType)
    {
        $this->model = $departmentType;
        $this->modelTranslation = $departmentTypeTranslation;
        $this->modelView = $viewDepartmentType;
    }
}
