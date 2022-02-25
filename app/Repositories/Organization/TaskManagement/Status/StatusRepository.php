<?php

namespace App\Repositories\Organization\TaskManagement\Status;

use App\Models\Organization\TaskManagement\Status\Status;
use App\Models\Organization\TaskManagement\Status\StatusTranslation;
use App\Repositories\Repository;

class StatusRepository extends Repository
{
    public function __construct(Status $status)
    {
        $this->model = $status;
    }
}
