<?php

namespace App\Services\Master\Page;

use App\Services\Service;
use App\Repositories\Master\Page\PageRepository;

class PageService extends Service
{
    public function __construct(PageRepository $pageRepository)
    {
        $this->repository = $pageRepository;
    }

    public function indexPage($data, $relation)
    {
        $module_id = $data['module_id'] ?? null;
        if ($module_id) return $this->get($relation)->where('module_id', $module_id)->get();
        else return $this->getPaginate($data, $relation);

    }
}
