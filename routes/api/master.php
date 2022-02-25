<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\{
    PageController,
    UserController,
    FileController,
    PhraseController,
    ModuleController,
    LanguageController,
    PagePhraseController,
    PermissionController,
    NationalityController,
    OrganizationController,
    UserOrganizationController,
    OrganizationModuleController,
    OrganizationLanguageController,
    PictureController
};

Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
Route::put('reset-password/{id}', [UserController::class, 'resetPassword'])->name('password.update');
Route::apiResource('page', PageController::class);
Route::apiResource('file', FileController::class)->except(['index','update']);
Route::apiResource('module', ModuleController::class);
Route::apiResource('phrase', PhraseController::class);
Route::get('get-phrase', [PhraseController::class, 'getPhrase'])->name('phrase.get_phrases');
Route::apiResource('picture', PictureController::class)->except(['show','index','destroy','update']);
Route::apiResource('language', LanguageController::class);
Route::apiResource('permission', PermissionController::class);
Route::apiResource('page-phrase', PagePhraseController::class)->except(['show']);
Route::apiResource('nationality', NationalityController::class);
Route::apiResource('organization', OrganizationController::class)->except(['store']);
Route::apiResource('user-organization', UserOrganizationController::class)->except(['show']);
Route::apiResource('organization-module', OrganizationModuleController::class)->except(['show']);
Route::apiResource('organization-language', OrganizationLanguageController::class)->except(['index']);
