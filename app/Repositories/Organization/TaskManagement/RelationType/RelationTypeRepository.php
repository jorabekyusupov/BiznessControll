<?php

namespace App\Repositories\Organization\TaskManagement\RelationType;

use App\Models\Organization\TaskManagement\RelationType\RelationType;
use App\Repositories\Repository;

class RelationTypeRepository extends Repository
{
    public function __construct(RelationType $relationType)
    {
        $this->model = $relationType;
    }
}
