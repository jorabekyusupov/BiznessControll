<?php

namespace App\Services\Organization\TaskManagement\Task;

use App\Services\Organization\TaskManagement\Folder\FolderService;
use App\Services\Service;
use App\Services\Organization\TaskManagement\Status\StatusService;
use App\Repositories\Organization\TaskManagement\Task\TaskRepository;
use App\Services\Organization\HumanResources\EmployeeStaff\EmployeeStaffService;
use App\Services\Organization\TaskManagement\RelatedEmployee\RelatedEmployeeService;
use App\Services\Organization\TaskManagement\RelationType\RelationTypeService;

class TaskService extends Service
{
    protected RelatedEmployeeService $relatedEmployeeService;

    public array $relation = [
        'owner.employee:id,user_id,first_name,last_name,middle_name',
        'executors:id,user_id,first_name,last_name,middle_name',
        'auditors:id,user_id,first_name,last_name,middle_name',

        'sub_task.owner.employee:id,user_id,first_name,last_name,middle_name',
        'sub_task.executors:id,user_id,first_name,last_name,middle_name',
        'sub_task.auditors:id,user_id,first_name,last_name,middle_name',
    ];
    protected EmployeeStaffService $employeeStaffService;
    protected RelationTypeService $relationTypeService;
    protected StatusService $statusService;
    protected FolderService $folderService;

    public function __construct(
        TaskRepository         $taskRepository,
        RelatedEmployeeService $relatedEmployeeService,
        EmployeeStaffService   $employeeStaffService,
        RelationTypeService    $relationTypeService,
        FolderService          $folderService,
        StatusService          $statusService
    )
    {
        $this->repository = $taskRepository;
        $this->relatedEmployeeService = $relatedEmployeeService;
        $this->employeeStaffService = $employeeStaffService;
        $this->relationTypeService = $relationTypeService;
        $this->folderService = $folderService;
        $this->statusService = $statusService;
    }

    public function filter($data, $relation)
    {
        $page = $data['page'] ?? 1;
        $rows = $data['rows'] ?? 100000;
//        $filter = $data['filter'] ?? null;
        $sort = $data['sort'] ?? null;
        $folder_id = $data['folder_id'] ?? null;

        $employee_id = $data['employee_id'] ?? auth()->user()->employee->id;
        $employee_status_id = $data['employee_status_id'] ?? null;
        $global = $data['global'] ?? null;
        $begin_date = $data['begin_date'] ?? null;
        $end_date = $data['end_date'] ?? null;
        $relation_type = $data['relation_type'] ?? false;


        $model = $this->getView(['owner', 'executors', 'auditors', 'watchers', 'sub_task'])

            ->whereNull('parent_id');


        if (isset($global)) {
            $model->where('title', 'ilike', '%' . $global . '%')
                ->orWhere('description', 'ilike', '%' . $global . '%');

        }
        if (isset($employee_id)) {
            $model->whereHas('employee', function ($query) use ($employee_id) {
                $query->where('employee_id', $employee_id);
            });
            if (isset($employee_status_id)) {
                $model->whereHas('related_employees', function ($related_employee) use ($employee_status_id) {
                    $related_employee->where('status_id', $employee_status_id);
                });
            }
        }
        if (isset($begin_date)) {
            $model->whereBetween('begin_date', [$begin_date, $end_date ?? date('Y-m-d', strtotime($begin_date . ' +1 day'))]);
        }

        if (isset($folder_id)) {
            $model->where('folder_id', $folder_id);
        }

        return $model->latest()->paginate($rows, ['*'], 'page name', $page);
    }

    public function group($data)
    {
        $date_range = $data['date_range'] ?? null;
        $date_range = json_decode($date_range);

        $group_type = $data['group_type'];
        $employee_id = auth()->user()->employee->id; // $data['employee_id'];
        $start_date = $date_range[0] ?? null;
        $end_date = $date_range[1] ?? null;
        $global_search = $data['global_search'] ?? null;

        $group = [];
        $groups = match ($group_type) {
            '1' => $this->relationTypeService->get()->get(),
            '2' => $this->employeeStaffService->get()->where('employee_id', $employee_id)->with('staff')->get()->pluck('staff'),
            '3' => $this->statusService->get()->get(),
        };

        foreach ($groups as $key1 => $value) {
            $tasks = null;
            $models = $this->getModels($employee_id, $global_search, $start_date, $end_date);
            $group[$key1]['name'] = $value->name ?? $value->position_name;

            $filter_column = match ($group_type) {
                '1' => 'relation_type_id',
                '2' => 'staff_id',
                '3' => 'status_id',
            };

            $tasks = $models->whereNull('parent_id')->where($filter_column, $value->id)->get();
            $group[$key1]['tasks'] = $tasks;

        }
        $models = $this->getModels($employee_id, $global_search, $start_date, $end_date);

        if ($group_type == 2) {
            $group[] = array('name' => 'default', 'tasks' => $models->whereNull('staff_id')->get());
        }

        return $group;

    }

    public function getModels($employee_id, mixed $global_search, mixed $start_date, mixed $end_date)
    {
        $models = $this->relatedEmployeeService->getView($this->relationTypeService->get()->get()->pluck('name'))
            ->where('employee_id', $employee_id);

        if (isset($global_search) && $global_search) {
            $models->where('title', 'ilike', '%' . $global_search . '%')
                ->orWhere('description', 'ilike', '%' . $global_search . '%');
        }

        if (isset($start_date) && $start_date) {
            $models->whereBetween('begin_date', [$start_date, $end_date ?? date('Y-m-d', strtotime($start_date . ' +1 day'))]);
        }
        return $models;
    }

    public function showTask($id)
    {
        $task = $this->showView($id, ['folder', 'file', 'sub_task', 'owner', 'executors', 'auditors', 'watchers']);
        if ($task->getStatusCode() != 404) {
            $task = $task->getData();
            if (isset($task->folder_id))
                $task->folders = $this->folderService->treePath($task->folder_id, 1, []);
        } else return response('Not found', 404);
        return $task;
    }

}
