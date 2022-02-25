<?php

namespace App\Models\Organization\TaskManagement\RelatedEmployee;

use App\Models\Organization\Basic\Employee\ViewEmployee;
use App\Models\Organization\HumanResources\Staff\ViewStaff;
use App\Models\Organization\Organization;
use App\Models\Organization\TaskManagement\Task\ViewTasks;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\RelatedEmployeeFactory;

class RelatedEmployee extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = RelatedEmployeeFactory::class;

    protected $table = 'tm_related_employees';

    public $timestamps = false;

    public $fillable = [
        'relation_type_id',
        'task_id',
        'employee_id',
        'staff_id',
        'expected_duration',
        'actual_duration',
        'begin_date',
        'status_id'
    ];

    public function task()
    {
        return $this->hasOne(ViewTasks::class, 'id', 'task_id');
    }

    public function employee()
    {
        return $this->hasOne(ViewEmployee::class, 'id', 'employee_id');
    }

    public function staff()
    {
        return $this->hasOne(ViewStaff::class, 'id', 'staff_id');
    }

}
