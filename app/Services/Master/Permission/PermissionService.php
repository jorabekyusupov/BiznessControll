<?php

namespace App\Services\Master\Permission;

use App\Repositories\Master\Permission\PermissionRepository;
use App\Services\Service;

class PermissionService extends Service
{

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->repository = $permissionRepository;
    }
}
