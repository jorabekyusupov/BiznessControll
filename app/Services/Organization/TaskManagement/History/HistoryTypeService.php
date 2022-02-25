<?php

namespace App\Services\Organization\TaskManagement\History;

use App\Repositories\Organization\TaskManagement\History\HistoryTypeRepository;
use App\Services\Service;

class HistoryTypeService extends Service
{
    public function __construct(HistoryTypeRepository $historyTypeRepository)
    {
        $this->repository = $historyTypeRepository;
    }

}
