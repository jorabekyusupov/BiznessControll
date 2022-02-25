<?php
namespace App\Services\Organization\HumanResources\DepartmentType;

use App\Repositories\Organization\HumanResources\DepartmentType\DepartmentTypeRepository;
use App\Services\Service;

class DepartmentTypeService extends Service {

    public function __construct(DepartmentTypeRepository $departmentTypeRepository)
    {
        $this->repository = $departmentTypeRepository;
    }
}
