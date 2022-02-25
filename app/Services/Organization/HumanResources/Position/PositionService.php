<?php

namespace App\Services\Organization\HumanResources\Position;

use App\Repositories\Organization\HumanResources\Position\PositionRepository;
use App\Services\Service;

class PositionService extends Service
{
    public function __construct(PositionRepository $positionRepository)
    {
        $this->repository = $positionRepository;
    }

}
