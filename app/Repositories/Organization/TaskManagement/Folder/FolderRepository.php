<?php

namespace App\Repositories\Organization\TaskManagement\Folder;

use App\Models\Organization\TaskManagement\Folder\Folder;
use App\Repositories\Repository;

class FolderRepository extends Repository
{
    public function __construct(Folder $folder)
    {
        $this->model = $folder;
    }
}
