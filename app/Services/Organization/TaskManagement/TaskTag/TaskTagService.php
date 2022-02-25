<?php

namespace App\Services\Organization\TaskManagement\TaskTag;

use App\Repositories\Organization\TaskManagement\TaskTag\TaskTagRepository;
use App\Services\Service;

class TaskTagService extends Service
{
    public function __construct(TaskTagRepository $taskTagRepository)
    {
        $this->repository = $taskTagRepository;
    }
}
