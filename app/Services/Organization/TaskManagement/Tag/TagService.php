<?php

namespace App\Services\Organization\TaskManagement\Tag;

use App\Repositories\Organization\TaskManagement\Tag\TagRepository;
use App\Services\Service;

class TagService extends Service
{
    public function __construct(TagRepository $tagRepository)
    {
        $this->repository = $tagRepository;
    }
}
