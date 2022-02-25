<?php

namespace App\Services\Organization\TaskManagement\History;

use App\Repositories\Organization\TaskManagement\History\HistoryRepository;
use App\Services\Service;

class HistoryService extends Service
{
    public function __construct(
        HistoryRepository $historyRepository,
    )
    {
        $this->repository = $historyRepository;
    }

    public function historyStore($task_id, $type, $new = null, $old = null)
    {
        $data['user_id'] = auth()->user()->id ?? 1;
        $data['task_id'] = $task_id;
        $data['type'] = $type;
        $data['old'] = $old ?? null;
        $data['new'] = $new ?? null;
        $this->store($data);
    }

    public function list($task_id, $relation = null)
    {
        $model = $this->get($relation)->where('task_id', $task_id)->latest()->get();
        return $model ?? [];
    }
}
