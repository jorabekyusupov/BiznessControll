<?php

namespace App\Services\Organization\TaskManagement\Comment;

use App\Repositories\Organization\TaskManagement\Comment\CommentRepository;
use App\Services\Service;

class CommentService extends Service
{
    public function __construct(CommentRepository $commentRepository)
    {
        $this->repository = $commentRepository;
    }

    public function list($task_id, $relation = null)
    {
        $model = $this->get($relation)->where('task_id', $task_id)->oldest('created_at')->get();
        return $model ?? $model = [];
    }
}
