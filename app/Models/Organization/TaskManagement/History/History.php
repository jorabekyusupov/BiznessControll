<?php

namespace App\Models\Organization\TaskManagement\History;

use App\Models\Master\File;
use App\Models\Organization\Basic\Employee\ViewEmployee;
use App\Models\Organization\Organization;
use App\Models\Organization\TaskManagement\Folder\Folder;
use App\Models\Organization\TaskManagement\Priority\Priority;
use App\Models\Organization\TaskManagement\RelatedEmployee\ViewEmployeeTask;
use App\Models\Organization\TaskManagement\Status\Status;
use App\Models\Organization\TaskManagement\Task\Task;
use App\Models\Organization\TaskManagement\Type\Type;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\HistoryFactory;

class History extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = HistoryFactory::class;

    protected $table = 'tm_histories';

    protected $fillable = [
        'task_id',
        'list_id',
        'type',
        'old',
        'new',
        'user_id',
        'created_by',
        'updated_by'
    ];

    public function created_user()
    {
        return $this->hasOne(ViewEmployee::class, 'user_id', 'created_by')->select('id', 'user_id', 'avatar', 'first_name', 'last_name', 'middle_name');
    }

    public function parent_new()
    {
        return $this->belongsTo(Task::class, 'new', 'id')->select('id', 'title');
    }

    public function parent_old()
    {
        return $this->belongsTo(Task::class, 'old', 'id')->select('id', 'title');
    }

    public function related_employee_new()
    {
        return $this->BelongsTo(ViewEmployee::class, 'new', 'id')->select('id', 'user_id', 'first_name', 'last_name');
    }

    public function related_employee_old()
    {
        return $this->BelongsTo(ViewEmployee::class, 'old', 'id')->select('id', 'user_id', 'first_name', 'last_name');
    }

    public function folder_new()
    {
        return $this->belongsTo(Folder::class, 'new', 'id')->select('id', 'name');
    }

    public function folder_old()
    {
        return $this->belongsTo(Folder::class, 'old', 'id')->select('id', 'name');
    }

    public function status_new()
    {
        return $this->belongsTo(Status::class, 'new', 'id')->select('id', 'name');
    }

    public function status_old()
    {
        return $this->belongsTo(Status::class, 'old', 'id')->select('id', 'name');
    }

//    public function employee_status_new()
//    {
//        return $this->belongsTo(ViewEmployeeTask::class, 'new', 'id');
//            ->select('id', 'status_name', 'first_name', 'last_name');
//    }
//
//    public function employee_status_old()
//    {
//        return $this->belongsTo(ViewEmployeeTask::class, 'old', 'id');
//            ->select('id', 'status_name', 'first_name', 'last_name');
//    }

    public function priority_new()
    {
        return $this->belongsTo(Priority::class, 'new', 'id')->select('id', 'name');
    }

    public function priority_old()
    {
        return $this->belongsTo(Priority::class, 'old', 'id')->select('id', 'name');
    }

    public function task_type_old()
    {
        return $this->belongsTo(Type::class, 'old', 'id')->select('id', 'name');
    }

    public function task_type_new()
    {
        return $this->belongsTo(Type::class, 'new', 'id')->select('id', 'name');
    }

    public function task_file_old()
    {
        return $this->belongsTo(File::class, 'old', 'physical_name')->select('id', 'physical_name');
    }

    public function task_file_new()
    {
        return $this->belongsTo(File::class, 'new', 'physical_name')->select('id', 'physical_name');
    }

}
