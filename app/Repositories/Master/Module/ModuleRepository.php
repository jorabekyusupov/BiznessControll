<?php

namespace App\Repositories\Master\Module;

use App\Models\Master\Module;
use App\Repositories\Repository;

class ModuleRepository extends Repository
{
    public function __construct(Module $module)
    {
        $this->model = $module;
    }

}
