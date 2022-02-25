<?php

namespace App\Repositories\Organization\TaskManagement\TaskExtraColumn;

use App\Models\Organization\TaskManagement\TaskExtraColumn\TaskExtraColumn;
use App\Repositories\Repository;

class TaskExtraColumnRepository extends Repository
{
    public function __construct(TaskExtraColumn $taskExtraColumn)
    {
        $this->model = $taskExtraColumn;
    }
}

