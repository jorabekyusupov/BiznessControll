<?php

use Illuminate\Support\Facades\Route;

Route::group([], base_path('routes/api/modules/basic.php'));
Route::prefix('hr')->name('hr.')->group(base_path('routes/api/modules/hr.php'));
Route::prefix('tm')->name('tm.')->group(base_path('routes/api/modules/tm.php'));
Route::prefix('at')->name('at.')->group(base_path('routes/api/modules/at.php'));
