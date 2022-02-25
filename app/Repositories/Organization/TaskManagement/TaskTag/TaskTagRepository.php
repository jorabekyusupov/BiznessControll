<?php

namespace App\Repositories\Organization\TaskManagement\TaskTag;

use App\Models\Organization\TaskManagement\TaskTag\TaskTag;
use App\Repositories\Repository;

class TaskTagRepository extends Repository
{
    public function __construct(TaskTag $taskTag)
    {
        $this->model = $taskTag;
    }

}
