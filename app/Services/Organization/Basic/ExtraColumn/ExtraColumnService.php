<?php

namespace App\Services\Organization\Basic\ExtraColumn;

use App\Repositories\Organization\HumanResources\DepartmentExtraColumn\DepartmentExtraColumnRepository;
use App\Repositories\Organization\Basic\ExtraColumn\ExtraColumnRepository;
use App\Services\Service;

class ExtraColumnService extends Service
{
    protected DepartmentExtraColumnRepository $departmentExtraColumnRepository;

    public function __construct(
        ExtraColumnRepository $extraColumnRepository,
        DepartmentExtraColumnRepository $departmentExtraColumnRepository
    ) {
        $this->repository = $extraColumnRepository;
        $this->departmentExtraColumnRepository = $departmentExtraColumnRepository;
    }

    public function olddeleteExtraColumns($id)
    {
        $department_extra_columns = $this->departmentExtraColumnRepository->query()
            ->where('extra_column_id', $id)->get();
        foreach ($department_extra_columns as $department_extra_column) {
            $department_extra_column->delete();
        }
        $this->delete($id);
    }

    public function deleteExtraColumn($id)
    {
        $model = $this->delete($id);
        if ($model){
            $this->departmentExtraColumnRepository->query()
                ->where('extra_column_id', $id)->delete();
            $this->repository->modelTranslation->query()
                ->where('object_id', $id)->delete();
        }
        return $model;

    }

}
