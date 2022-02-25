<?php

namespace App\Services\Organization\HumanResources\Department;

use App\Repositories\Organization\HumanResources\Department\DepartmentRepository;
use App\Services\Organization\HumanResources\DepartmentExtraColumn\DepartmentExtraColumnService;
use App\Services\Organization\Basic\ExtraColumn\ExtraColumnService;
use App\Services\Service;

class DepartmentService extends Service
{

    protected ExtraColumnService $extraColumnService;
    protected DepartmentExtraColumnService $departmentExtraColumnService;

    public function __construct(
        DepartmentRepository         $departmentRepository,
        ExtraColumnService           $extraColumnService,
        DepartmentExtraColumnService $departmentExtraColumnService
    )
    {
        $this->repository = $departmentRepository;
        $this->extraColumnService = $extraColumnService;
        $this->departmentExtraColumnService = $departmentExtraColumnService;
    }

    public function getDepartmentTree($id)
    {
        $department = $this->getView(['staff.employees', 'departmentExtraColumns.extraColumns'])
            ->where('parent_id', $id)
            ->where(function ($query) {
                $query->where('language_code', auth()->user()->language_code)
                    ->where('dt_language_code', auth()->user()->language_code);
            })
            ->first();
        if ($department)
            $department->children = $this->getDepTree($department->id);
        return $department;
    }

    public function getDepTree($id)
    {
        $departments = $this->getView(['staff.employees', 'departmentExtraColumns.extraColumns'])
            ->where('parent_id', $id)
            ->where(function ($query) {
                $query->where('language_code', auth()->user()->language_code)
                    ->where('dt_language_code', auth()->user()->language_code);
            })
            ->orderBy('sequence')->orderBy('id')->get();
        foreach ($departments as $department) {
            $department->children = $this->getDepTree($department->id);
        }
        return $departments;
    }


    public function showDepartment(int $id, $relations = null)
    {
        $allExtraColumns = $this->extraColumnService->get()->get();
        $models = $this->departmentExtraColumnService->get(['extraColumns'])
            ->where('department_id', $id)
            ->get()->pluck('extra_column_id');
        $extraColumns = $allExtraColumns->whereNotIn('id', $models);
        foreach ($extraColumns as $key => $extraColumn) {
            $data['extra_column_id'] = $extraColumn->id;
            $data['department_id'] = $id;
            $data['value'] = '';
            $this->departmentExtraColumnService->store($data);
        }
        return $this->showTranslation($id, 'o', ['translations', 'departmentExtraColumns.extraColumns']);
    }

}
