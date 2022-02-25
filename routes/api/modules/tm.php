<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Organization\TaskManagement\{
    TagController,
    TypeController,
    TaskController,
    StatusController,
    FolderController,
    CommentController,
    TaskTagController,
    HistoryController,
    PriorityController,
    TaskReportController,
    HistoryTypeController,
    RelationTypeController,
    FolderEmployeeController,
    TaskExtraColumnController,
    RelatedEmployeeController,
    EmployeeFavoriteTaskController
};

Route::apiResource('tag', TagController::class);
Route::apiResource('type', TypeController::class);
Route::apiResource('task', TaskController::class);
Route::apiResource('status', StatusController::class);
Route::apiResource('folder', FolderController::class);
Route::apiResource('history', HistoryController::class);
Route::apiResource('comment', CommentController::class);
Route::apiResource('task-tag', TaskTagController::class)->except(['index']);
Route::apiResource('priority', PriorityController::class);
Route::apiResource('history-type', HistoryTypeController::class);
Route::apiResource('relation-type', RelationTypeController::class);
Route::apiResource('related-employee', RelatedEmployeeController::class);
Route::apiResource('task-extra-column', TaskExtraColumnController::class);
Route::apiResource('employee-favorite-task', EmployeeFavoriteTaskController::class)->except(['index']);
Route::apiResource('folder-employee', FolderEmployeeController::class)->only(['store', 'destroy']);
Route::get('report', [TaskReportController::class, 'report'])->name('report');
Route::get('group', [TaskReportController::class, 'group'])->name('group');
Route::get('folder-path/{id}', [FolderController::class, 'folderPath'])->name('folder_path');
