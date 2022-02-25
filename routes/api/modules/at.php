<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Organization\AttendanceManagement\{
    AttendanceController
};


Route::prefix('attendance')->name('attendance.')->group(function() {
    
    Route::post('in', [AttendanceController::class, 'in'])->name('in');
    Route::post('out', [AttendanceController::class, 'out'])->name('out');
    Route::get('status', [AttendanceController::class, 'status'])->name('status');
    
});

Route::apiResource('attendance', AttendanceController::class);