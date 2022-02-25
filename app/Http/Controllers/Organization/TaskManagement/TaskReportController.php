<?php

namespace App\Http\Controllers\Organization\TaskManagement;

use App\Http\Controllers\Controller;
use App\Http\Resources\Organization\TaskManagement\TaskReportResource;
use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\Organization\TaskManagement\Task\ViewTasks;
use App\Services\Organization\Basic\Employee\EmployeeService;
use App\Services\Organization\TaskManagement\Task\TaskService;
use App\Http\Requests\Organization\TaskManagement\TaskReport\TaskGroupRequest;
use Illuminate\Http\Request;

class TaskReportController extends Controller
{
    private TaskService $taskService;
    private EmployeeService $employeeService;

    public function __construct(
        TaskService     $taskService,
        EmployeeService $employeeService,

    )
    {
        $this->taskService = $taskService;
        $this->employeeService = $employeeService;
    }

    public function report(Request $request)
    {
        $data_range = json_decode($request->input('date_range'));
        $global_search = $request->input('global_search');
        $employees = $this->employeeService->getView()
            ->where('is_active', 1)
            ->with(['employee_main_staff' => function ($query) {
                $query
                    ->select('id', 'staff_id', 'is_main_staff', 'employee_id', 'is_active')
                    ->with('staff:id,position_name,department_name');
            }]);

        if (isset($global_search)) {
            $employees->where(function ($search) use ($global_search) {
                $search->where('first_name', 'ilike', '%' . $global_search . '%')
                    ->orWhere('last_name', 'ilike', '%' . $global_search . '%')
                    ->orWhere('middle_name', 'ilike', '%' . $global_search . '%')
                    ->orWhereHas('employee_main_staff', function ($emp) use ($global_search) {
                        $emp->whereHas('staff', function ($staff) use ($global_search) {
                            $staff->where('position_name', 'ilike', '%' . $global_search . '%');
                            $staff->orWhere('department_name', 'ilike', '%' . $global_search . '%');
                        });
                    });
            });
        }
        $employees = $employees->get();

        foreach ($employees as $employee) {
            if (isset($data_range)) {
                $employee->open = ViewTasks::whereBetween('begin_date', $data_range)
                    ->whereHas('related_employees', function ($q) use ($employee, $data_range) {
                        $q->where('employee_id', $employee->id)->where('status_id', 1);
                    })->count();
                $employee->processing = ViewTasks::whereBetween('begin_date', $data_range)
                    ->whereHas('related_employees', function ($q) use ($employee, $data_range) {
                        $q->where('employee_id', $employee->id)->where('status_id', 2);
                    })->count();
                $employee->review = ViewTasks::whereBetween('begin_date', $data_range)
                    ->whereHas('related_employees', function ($q) use ($employee, $data_range) {
                        $q->where('employee_id', $employee->id)->where('status_id', 3);
                    })->count();
                $employee->closed = ViewTasks::whereBetween('begin_date', $data_range)
                    ->whereHas('related_employees', function ($q) use ($employee, $data_range) {
                        $q->where('employee_id', $employee->id)->where('status_id', 4);
                    })->count();
            } else {
                $employee->open = ViewTasks::whereHas('related_employees', function ($q) use ($employee) {
                    $q->where('employee_id', $employee->id)->where('status_id', 1);
                })->count();
                $employee->processing = ViewTasks::whereHas('related_employees', function ($q) use ($employee) {
                    $q->where('employee_id', $employee->id)->where('status_id', 2);
                })->count();
                $employee->review = ViewTasks::whereHas('related_employees', function ($q) use ($employee) {
                    $q->where('employee_id', $employee->id)->where('status_id', 3);
                })->count();
                $employee->closed = ViewTasks::whereHas('related_employees', function ($q) use ($employee) {
                    $q->where('employee_id', $employee->id)->where('status_id', 4);
                })->count();
            }
        }

        return ['data' => $employees, 'total' => $employees->count()];

    }

    public function group(TaskGroupRequest $taskGroupRequest)
    {
        return $this->taskService->group($taskGroupRequest->validated());
    }
}
