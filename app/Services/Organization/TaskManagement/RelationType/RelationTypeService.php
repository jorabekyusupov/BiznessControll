<?php

namespace App\Services\Organization\TaskManagement\RelationType;

use App\Repositories\Organization\TaskManagement\RelationType\RelationTypeRepository;
use App\Services\Service;

class RelationTypeService extends Service
{
    public function __construct(RelationTypeRepository $relationTypeRepository)
    {
        $this->repository = $relationTypeRepository;
    }
}
