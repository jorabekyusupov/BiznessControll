<?php

namespace App\Http\Resources\Organization\TaskManagement;

use Illuminate\Http\Resources\Json\JsonResource;

class HistoryResource extends JsonResource
{

    public function toArray($request)
    {
        $history = [
            'id' => $this->id,
            'type' => $this->type,
            'created_by' => $this->created_user,
            'created_at' => $this->created_at,

            $this->mergeWhen($this->type === 'title', [
                'old' => $this->old,
                'new' => $this->new,
            ]),

            $this->mergeWhen($this->type === 'task_type', [
                'old' => $this->task_type_old,
                'new' => $this->task_type_new,
            ]),

            $this->mergeWhen($this->type === 'folder', [
                'old' => $this->folder_old,
                'new' => $this->folder_new,
            ]),

            $this->mergeWhen($this->type === 'status', [
                'old' => $this->status_old,
                'new' => $this->status_new,
            ]),

//            $this->mergeWhen($this->type === 'employee_status', [
//                'old' => $this->employee_status_old,
//                'new' => $this->employee_status_new,
//            ]),

            $this->mergeWhen($this->type === 'priority', [
                'old' => $this->priority_old,
                'new' => $this->priority_new,
            ]),

            $this->mergeWhen($this->type === 'parent_id', [
                'old' => $this->parent_old,
                'new' => $this->parent_new,
            ]),

            $this->mergeWhen($this->type === 'owner', [
                'old' => $this->related_employee_old,
                'new' => $this->related_employee_new,
            ]),

            $this->mergeWhen($this->type === 'executor', [
                'old' => $this->related_employee_old,
                'new' => $this->related_employee_new,
            ]),

            $this->mergeWhen($this->type === 'auditor', [
                'old' => $this->related_employee_old,
                'new' => $this->related_employee_new,
            ]),

            $this->mergeWhen($this->type === 'watcher', [
                'old' => $this->related_employee_old,
                'new' => $this->related_employee_new,
            ]),

            $this->mergeWhen($this->type === 'description', [
                'old' => $this->old,
                'new' => $this->new,
            ]),

            $this->mergeWhen($this->type === 'expected_result', [
                'old' => $this->old,
                'new' => $this->new,
            ]),

            $this->mergeWhen($this->type === 'actual_result', [
                'old' => $this->old,
                'new' => $this->new,
            ]),

            $this->mergeWhen($this->type === 'expected_duration', [
                'old' => $this->old,
                'new' => $this->new,
            ]),

            $this->mergeWhen($this->type === 'actual_duration', [
                'old' => $this->old,
                'new' => $this->new,
            ]),

            $this->mergeWhen($this->type === 'begin_date', [
                'old' => $this->old,
                'new' => $this->new,
            ]),

            $this->mergeWhen($this->type === 'end_date', [
                'old' => $this->old,
                'new' => $this->new,
            ]),

            $this->mergeWhen($this->type === 'task_file', [
                'old' => $this->task_file_old,
                'new' => $this->task_file_new,
            ]),

        ];

        return $history;
    }
}
