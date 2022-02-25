<?php

namespace App\Repositories\Master\Picture;

use App\Models\Master\Picture;
use App\Repositories\Repository;

class PictureRepository extends Repository
{
    protected Picture $picture;

    public function __construct(Picture $picture)
    {
        $this->model = $picture;
    }
}
