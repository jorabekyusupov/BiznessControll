<?php

namespace App\Services\Organization\HumanResources\DepartmentExtraColumn;

use App\Repositories\Organization\HumanResources\DepartmentExtraColumn\DepartmentExtraColumnRepository;
use App\Services\Service;

class DepartmentExtraColumnService extends Service
{
    public function __construct(DepartmentExtraColumnRepository $departmentExtraColumnRepository)
    {
        $this->repository = $departmentExtraColumnRepository;
    }

    public function indexDepartmentExtraColumn($data, $relation = null)
    {
        $department_id = $data['department_id'] ?? null;
        if ($department_id) return $this->get($relation)->where('department_id', $department_id)->get();
        else return $this->getPaginate($data);
    }



}
