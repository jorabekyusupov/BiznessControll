<?php

namespace App\Repositories\Organization\HumanResources\Position;

use App\Models\Organization\HumanResources\Position\Position;
use App\Models\Organization\HumanResources\Position\PositionTranslation;
use App\Models\Organization\HumanResources\Position\ViewPosition;
use App\Repositories\Repository;

class PositionRepository extends Repository
{
    public function __construct(Position $position, PositionTranslation $positionTranslation, ViewPosition $viewPosition)
    {
        $this->model = $position;
        $this->modelTranslation = $positionTranslation;
        $this->modelView = $viewPosition;
    }

}
