<?php

namespace App\Services\Master\File;

use App\Repositories\Master\File\FileRepository;
use App\Services\Service;

class FileService extends Service
{
    public function __construct(FileRepository $fileRepository)
    {
        $this->repository = $fileRepository;
    }

    public function fileDelete($id, $path)
    {
        $file = $this->show($id);
        if ($file){
            if (file_exists(storage_path().$path.$file->file_name)){
                unlink(storage_path().$path.$file->file_name);
            }
          return $this->delete($id);
        }
    }
}
