<?php

namespace App\Repositories\Organization\TaskManagement\Type;

use App\Models\Organization\TaskManagement\Type\Type;
use App\Models\Organization\TaskManagement\Type\TypeTranslation;
use App\Repositories\Repository;

class TypeRepository extends Repository
{
    public function __construct(Type $type)
    {
        $this->model = $type;
    }
}
