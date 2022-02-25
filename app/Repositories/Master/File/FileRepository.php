<?php

namespace App\Repositories\Master\File;

use App\Models\Master\File;
use App\Repositories\Repository;

class FileRepository extends Repository
{
    public function __construct(File $file)
    {
        $this->model = $file;
    }

}
