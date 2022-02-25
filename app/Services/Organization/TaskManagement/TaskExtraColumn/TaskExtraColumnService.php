<?php

namespace App\Services\Organization\TaskManagement\TaskExtraColumn;

use App\Repositories\Organization\TaskManagement\TaskExtraColumn\TaskExtraColumnRepository;
use App\Services\Service;

class TaskExtraColumnService extends Service
{
    public function __construct(TaskExtraColumnRepository $taskExtraColumnRepository)
    {
        $this->repository = $taskExtraColumnRepository;
    }
}

