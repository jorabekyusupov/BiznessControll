<?php

namespace App\Repositories\Master\Page;

use App\Models\Master\Page;
use App\Repositories\Repository;

class PageRepository extends Repository
{
    public function __construct(Page $page)
    {
        $this->model = $page;
    }
}
