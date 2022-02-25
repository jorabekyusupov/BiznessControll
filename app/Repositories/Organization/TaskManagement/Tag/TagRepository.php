<?php

namespace App\Repositories\Organization\TaskManagement\Tag;

use App\Models\Organization\TaskManagement\Tag\Tag;
use App\Repositories\Repository;

class TagRepository extends Repository
{
    public function __construct(Tag $tag)
    {
        $this->model = $tag;
    }
}
