<?php

namespace App\Repositories\Organization\TaskManagement\History;

use App\Models\Organization\TaskManagement\History\HistoryType;
use App\Repositories\Repository;

class HistoryTypeRepository extends Repository
{
    public function __construct(HistoryType $historyType)
    {
        $this->model = $historyType;
    }

}
