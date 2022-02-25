<?php

namespace App\Services\Organization\TaskManagement\Folder;

use App\Repositories\Organization\TaskManagement\Folder\FolderRepository;
use App\Services\Service;

class FolderService extends Service
{

    public function __construct(FolderRepository $folderRepository)
    {
        $this->repository = $folderRepository;
    }

    public function treePath($folder_id, $key, $new)
    {
        $folder = $this->show($folder_id)->getData();
        $new[$key] = ['id' => $folder->id, 'name' => $folder->name];
        if ($folder->parent_id) {
            return $this->treePath($folder->parent_id, $key + 1, $new);
        }
        return array_reverse($new);
    }
}
