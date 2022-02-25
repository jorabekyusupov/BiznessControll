<?php

namespace App\Repositories\Organization\TaskManagement\Task;

use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\Organization\TaskManagement\Task\ViewTasks;
use App\Repositories\Repository;

class TaskRepository extends Repository
{
    public function __construct(Task $task, ViewTasks $viewTasks)
    {
        $this->model = $task;
        $this->modelView = $viewTasks;
    }
}
