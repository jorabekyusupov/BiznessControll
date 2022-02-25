<?php

namespace App\Services\Organization\TaskManagement\FolderEmployee;

use App\Repositories\Organization\TaskManagement\FolderEmployee\FolderEmployeeRepository;
use App\Services\Service;

class FolderEmployeeService extends Service
{
    public function __construct(FolderEmployeeRepository $folderEmployeeRepository)
    {
        $this->repository = $folderEmployeeRepository;
    }

}
