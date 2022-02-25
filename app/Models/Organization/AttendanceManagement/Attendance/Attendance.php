<?php

namespace App\Models\Organization\AttendanceManagement\Attendance;

use App\Models\Organization\Basic\Employee\Employee;
use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\AttendanceManagement\AttendanceFactory;

class Attendance extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = AttendanceFactory::class;
    protected $table = 'at_attendances';

    protected $fillable = [
        'employee_id',
        'in',
        'out',
        'duration',
        'created_by',
        'updated_by',
        'updated_at',
        'created_at'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

}
