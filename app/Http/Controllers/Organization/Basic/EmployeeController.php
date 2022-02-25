<?php

namespace App\Http\Controllers\Organization\Basic;


use App\Http\Controllers\Controller;
use App\Http\Requests\IndexRequest;
use App\Http\Requests\Organization\Basic\Employee\EmployeeStoreRequest;
use App\Services\Organization\Basic\Employee\EmployeeService;
use App\Http\Requests\Organization\Basic\Employee\EmployeeStoreUpdateRequest;
use JetBrains\PhpStorm\Pure;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index(IndexRequest $indexRequest)
    {
        return $this->employeeService->indexEmployee($indexRequest->validated());
    }

    public function show($id)
    {
        return $this->employeeService->showTranslation($id, 'o',
            ['translations.language', 'user', 'employee_staff.staff', 'user_organizations']);
    }

    public function update($id, EmployeeStoreUpdateRequest $employeeStoreUpdateRequest)
    {
        $data = $employeeStoreUpdateRequest->validated();
        $data['updated_at'] = now();
        return $this->employeeService->edit($id, $data);
    }
    #[Pure] public function destroy($id)
    {
        return $this->employeeService->deleteEmployee($id);
    }
}
