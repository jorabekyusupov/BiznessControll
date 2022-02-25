<?php

namespace App\Observers\Master;

use App\Models\Master\File;
use App\Services\Organization\TaskManagement\History\HistoryService;

class FileObserver
{
    protected HistoryService $historyService;

    public function __construct(HistoryService $historyService)
    {
        $this->historyService = $historyService;
    }


    public function created(File $file)
    {
        if ($file->object_type == 'task_file' || $file->object_type == 'task_comment_file'){
            $this->historyService->historyStore($file->object_id, $file->object_type, $file->physical_name);
        }

    }


    public function updated(File $file)
    {

    }


    public function deleted(File $file)
    {
        if ($file->object_type == 'task_file' || $file->object_type == 'task_comment_file'){
            $this->historyService->historyStore($file->object_id, $file->object_type, null,$file->physical_name);
        }
    }


    public function restored(File $file)
    {
        //
    }


    public function forceDeleted(File $file)
    {
        //
    }
}
