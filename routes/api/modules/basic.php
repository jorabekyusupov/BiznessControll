<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\{
    UserController,
};
use App\Http\Controllers\Organization\Basic\{
    ModuleController as OrgModuleController,
    PhraseController as OrganizationPhraseController,
    EmployeeController,
    ExtraColumnController,
    EmployeeSettingController,
    EmployeePermissionController
};

Route::apiResource('module', OrgModuleController::class);
Route::apiResource('phrase', OrganizationPhraseController::class);
Route::get('phrase-translate', [OrganizationPhraseController::class, 'translate'])->name('translate');
Route::get('phrase-list', [OrganizationPhraseController::class, 'list'])->name('phrase-list');
Route::post('employee', [UserController::class, 'employee'])->name('employee_add');
Route::apiResource('employee', EmployeeController::class)->except('store');
Route::apiResource('phrase', OrganizationPhraseController::class);
Route::apiResource('module', OrgModuleController::class);
Route::apiResource('extra-column', ExtraColumnController::class);
Route::apiResource('employee-permission', EmployeePermissionController::class);
Route::apiResource('employee-setting', EmployeeSettingController::class)->except(['index']);
