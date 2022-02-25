<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Organization\HumanResources\{
    PositionController,
    StaffController,
    DepartmentController,
    EmployeeStaffController,
    DepartmentTypeController,
    DepartmentExtraColumnController
};

Route::get('department-tree', [DepartmentController::class, 'treeDepartment'])->name('tree_department');
Route::apiResource('staff', StaffController::class);
Route::apiResource('position', PositionController::class);
Route::apiResource('department', DepartmentController::class);
Route::apiResource('employee-staff', EmployeeStaffController::class);
Route::apiResource('department-type', DepartmentTypeController::class);
Route::apiResource('department-extra-column', DepartmentExtraColumnController::class);
