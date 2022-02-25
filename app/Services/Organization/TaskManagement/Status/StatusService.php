<?php

namespace App\Services\Organization\TaskManagement\Status;

use App\Repositories\Organization\TaskManagement\Status\StatusRepository;
use App\Services\Service;

class StatusService extends Service
{
    public function __construct(StatusRepository $statusRepository)
    {
        $this->repository = $statusRepository;
    }

    public function indexStatus($data)
    {
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 10000;
        $filter = $data['filter'] ?? null;
        $sort = $data['sort'] ?? null;

        return $this->get()->orderBy('sequence', 'ASC')
            ->paginate($rows, ['*'], 'page name', $page);
    }
}
