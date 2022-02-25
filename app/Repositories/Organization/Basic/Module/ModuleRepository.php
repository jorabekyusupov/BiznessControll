<?php

namespace App\Repositories\Organization\Basic\Module;

use App\Models\Organization\Basic\Module\Module;
use App\Repositories\Repository;

class ModuleRepository extends Repository
{
    public function __construct(Module $module)
    {
        $this->model = $module;
    }

}
