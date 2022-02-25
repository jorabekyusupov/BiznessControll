<?php

namespace App\Repositories\Master\Nationality;

use App\Models\Master\Nationality;
use App\Repositories\Repository;

class NationalityRepository extends Repository
{
    public function __construct(Nationality $nationality)
    {
        $this->model = $nationality;
    }
}

