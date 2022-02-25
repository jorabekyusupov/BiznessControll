<?php

namespace App\Repositories\Master\Permission;

use App\Models\Permission;
use App\Repositories\Repository;

class PermissionRepository extends Repository{

    public function __construct(Permission $permission)
    {
        $this->model = $permission;
    }
}
