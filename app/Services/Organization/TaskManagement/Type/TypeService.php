<?php

namespace App\Services\Organization\TaskManagement\Type;

use App\Repositories\Organization\TaskManagement\Type\TypeRepository;
use App\Services\Service;

class TypeService extends Service
{
    public function __construct(TypeRepository $typeRepository)
    {
        $this->repository = $typeRepository;
    }
}
