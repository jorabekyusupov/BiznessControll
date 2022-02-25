<?php

namespace App\Repositories\Organization\TaskManagement\Comment;

use App\Models\Organization\TaskManagement\Comment\Comment;
use App\Repositories\Repository;

class CommentRepository extends Repository
{
    public function __construct(Comment $comment)
    {
        $this->model = $comment;
    }

}
