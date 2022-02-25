<?php

namespace App\Observers\Organization\TaskManagement\RelatedEmployee;

use App\Models\Organization\TaskManagement\RelatedEmployee\RelatedEmployee;
use App\Services\Organization\TaskManagement\History\HistoryService;

class RelatedEmployeeObserver
{
    protected HistoryService $historyService;

    public function __construct(HistoryService $historyService)
    {
        $this->historyService = $historyService;
    }

    public function created(RelatedEmployee $relatedEmployee)
    {
        if ($relatedEmployee->relation_type_id == 2 && $relatedEmployee->isDirty('employee_id')) {
            $this->historyService->historyStore($relatedEmployee->task_id, 'executor', $relatedEmployee->employee_id);
        }
        if ($relatedEmployee->relation_type_id == 3 && $relatedEmployee->isDirty('employee_id')) {
            $this->historyService->historyStore($relatedEmployee->task_id, 'auditor', $relatedEmployee->employee_id);
        }
        if ($relatedEmployee->relation_type_id == 4 && $relatedEmployee->isDirty('employee_id')) {
            $this->historyService->historyStore($relatedEmployee->task_id, 'watcher', $relatedEmployee->employee_id);
        }

    }

    public function updated(RelatedEmployee $relatedEmployee)
    {
        if ($relatedEmployee->relation_type_id == 1 && $relatedEmployee->isDirty('employee_id')) {
            $this->historyService->historyStore($relatedEmployee->task_id, 'owner',
                $relatedEmployee->employee_id, $relatedEmployee->getOriginal('employee_id'));
        }
        if ($relatedEmployee->isDirty('expected_duration')) {
            $this->historyService->historyStore($relatedEmployee->task_id, 'expected_duration',
                $relatedEmployee->expected_duration, $relatedEmployee->getOriginal('expected_duration'));
        }
        if ($relatedEmployee->isDirty('actual_duration')) {
            $this->historyService->historyStore($relatedEmployee->task_id, 'actual_duration',
                $relatedEmployee->actual_duration, $relatedEmployee->getOriginal('actual_duration'));
        }
//        if ($relatedEmployee->isDirty('status_id')) {
//            $this->historyService->historyStore($relatedEmployee->task_id, 'employee_status',
//                $relatedEmployee->status_id, $relatedEmployee->getOriginal('status_id'));
//        }

    }

    public function deleted(RelatedEmployee $relatedEmployee)
    {
        if ($relatedEmployee->relation_type_id == 2) {
            $this->historyService->historyStore($relatedEmployee->task_id, 'executor', null, $relatedEmployee->employee_id);
        }
        if ($relatedEmployee->relation_type_id == 3) {
            $this->historyService->historyStore($relatedEmployee->task_id, 'auditor', null, $relatedEmployee->employee_id);
        }
        if ($relatedEmployee->relation_type_id == 4) {
            $this->historyService->historyStore($relatedEmployee->task_id, 'watcher', null, $relatedEmployee->employee_id);
        }

    }

    public function restored(RelatedEmployee $relatedEmployee)
    {
        //
    }


    public function forceDeleted(RelatedEmployee $relatedEmployee)
    {
        //
    }
}
