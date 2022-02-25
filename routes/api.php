<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Master\{
    UserController,
    PhraseController,
};

Route::post('register', [UserController::class, 'register'])->name('register');
Route::get('verify', [UserController::class, 'verify'])->name('verify');
Route::get('global-phrases', [PhraseController::class, 'global'])->name('global');

Route::group(['middleware' => 'auth:api', 'verified'], function () {
    Route::get('user/profile', [UserController::class, 'show'])->name('profile');
    Route::prefix('master')->name('master.')->group(base_path('routes/api/master.php'));
    Route::prefix('organization')->name('organization.')->group(base_path('routes/api/organization.php'));
});
