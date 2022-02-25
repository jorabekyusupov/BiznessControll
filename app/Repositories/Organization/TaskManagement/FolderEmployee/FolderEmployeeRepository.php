<?php

namespace App\Repositories\Organization\TaskManagement\FolderEmployee;
use App\Models\Organization\TaskManagement\FolderEmployee\FolderEmployee;
use App\Repositories\Repository;


class FolderEmployeeRepository extends Repository
{
    public function __construct(FolderEmployee $folderEmployee)
    {
        $this->model = $folderEmployee;
    }

}
