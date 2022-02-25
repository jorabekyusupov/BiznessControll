<?php

namespace App\Repositories\Organization\TaskManagement\History;

use App\Models\Organization\TaskManagement\History\History;
use App\Repositories\Repository;

class HistoryRepository extends Repository
{
    public function __construct(History $history)
    {
        $this->model = $history;
    }
}
