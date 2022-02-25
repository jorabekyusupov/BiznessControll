<?php

namespace App\Observers\Organization\TaskManagement\Task;

use App\Models\Organization\TaskManagement\Task\Task;
use App\Services\Organization\Basic\Employee\EmployeeService;
use App\Services\Organization\TaskManagement\Comment\CommentService;
use App\Services\Organization\TaskManagement\Task\TaskService;
use App\Services\Organization\TaskManagement\History\HistoryService;
use App\Services\Organization\TaskManagement\RelatedEmployee\RelatedEmployeeService;

class TaskObserver
{
    protected RelatedEmployeeService $relatedEmployeeService;
    protected TaskService $taskService;
    protected HistoryService $historyService;
    protected EmployeeService $employeeService;
    protected CommentService $commentService;

    public function __construct(
        RelatedEmployeeService $relatedEmployeeService,
        TaskService            $taskService,
        HistoryService         $historyService,
        EmployeeService        $employeeService,
        CommentService         $commentService
    )
    {
        $this->relatedEmployeeService = $relatedEmployeeService;
        $this->taskService = $taskService;
        $this->historyService = $historyService;
        $this->employeeService = $employeeService;
        $this->commentService = $commentService;
    }

    public function created(Task $task)
    {
        $data['task_id'] = $task->id;
        $data['relation_type_id'] = 1;
        $user_id = auth()->user()->id ?? 1;
        $data['employee_id'] = $this->employeeService->get()->where('user_id', $user_id)->first()->id;
        $this->relatedEmployeeService->store($data);

        $this->historyService->historyStore($task->id, 'owner', $data['employee_id']);

        if ($task->parent_id && !empty($task->parent_id)) {
            $this->historyService->historyStore($task->parent_id, 'parent_id', $task->id);
        }

        if ($task->title && !empty($task->title)) {
            $this->historyService->historyStore($task->id, 'title', $task->title);
        }

        if ($task->folder_id && !empty($task->folder_id)) {
            $this->historyService->historyStore($task->id, 'folder', $task->folder_id);
        }

        if ($task->description && !empty($task->description)) {
            $this->historyService->historyStore($task->id, 'description', $task->description);
        }

        if ($task->expected_result && !empty($task->expected_result)) {
            $this->historyService->historyStore($task->id, 'expected_result', $task->expected_result);
        }

        if ($task->actual_result && !empty($task->actual_result)) {
            $this->historyService->historyStore($task->id, 'actual_result', $task->actual_result);
        }

        //        if ($task->actual_duration && !empty($task->actual_duration)) {
//            $this->historyService->historyStore($task->id, 'actual_duration', $task->actual_duration);
//        }

        if ($task->end_date && !empty($task->end_date)) {
            $this->historyService->historyStore($task->id, 'end_date', $task->end_date);
        }
    }


    public function updated(Task $task)
    {
        if ($task->isDirty('type_id')) {
            $this->historyService->historyStore($task->id, 'task_type', $task->type_id, $task->getOriginal('type_id'));
        }
        if ($task->isDirty('title')) {
            $this->historyService->historyStore($task->id, 'title', $task->title, $task->getOriginal('title'));
        }
        if ($task->isDirty('folder_id')) {
            $this->historyService->historyStore($task->id, 'folder', $task->folder_id, $task->getOriginal('folder_id'));
        }
        if ($task->isDirty('status_id')) {
            $this->historyService->historyStore($task->id, 'status', $task->status_id, $task->getOriginal('status_id'));
        }
        if ($task->isDirty('priority_id')) {
            $this->historyService->historyStore($task->id, 'priority', $task->priority_id, $task->getOriginal('priority_id'));
        }
        if ($task->isDirty('description')) {
            $this->historyService->historyStore($task->id, 'description', $task->description, $task->getOriginal('description'));
        }
        if ($task->isDirty('expected_result')) {
            $this->historyService->historyStore($task->id, 'expected_result', $task->expected_result, $task->getOriginal('expected_result'));
        }
        if ($task->isDirty('actual_result')) {
            $this->historyService->historyStore($task->id, 'actual_result', $task->actual_result, $task->getOriginal('actual_result'));
        }
//        if ($task->isDirty('actual_duration')) {
//            $this->historyService->historyStore($task->id, 'actual_duration', $task->actual_duration, $task->getOriginal('actual_duration'));
//        }
        if ($task->isDirty('end_date')) {
            $this->historyService->historyStore($task->id, 'end_date', $task->end_date, $task->getOriginal('end_date'));
        }
        if ($task->isDirty('begin_date')) {
            $this->historyService->historyStore($task->id, 'begin_date', $task->begin_date, $task->getOriginal('begin_date'));
        }

    }

    public function deleted(Task $task)
    {
        if ($task->parent_id && !empty($task->parent_id)) {
            $this->historyService->historyStore($task->parent_id, 'parent_id', null, $task->getOriginal('id'));
        }
        $this->historyService->get()->where('task_id', $task->id)->delete();
        $this->commentService->get()->where('task_id', $task->id)->delete();
        $this->relatedEmployeeService->get()->where('task_id', $task->id)->delete();
    }


    public function restored(Task $task)
    {
        //
    }


    public function forceDeleted(Task $task)
    {
        //
    }
}
