<?php

namespace App\Models\Organization\TaskManagement\Task;

use App\Models\Master\File;
use App\Models\Organization\Organization;
use App\Models\Organization\TaskManagement\Folder\Folder;
use App\Models\Organization\TaskManagement\RelatedEmployee\RelatedEmployee;
use App\Models\Organization\TaskManagement\RelatedEmployee\ViewRelatedEmployee;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewTasks extends Organization
{
    protected $table = 'view_tm_tasks';

    public function sub_task()
    {
        return $this->hasMany(ViewTasks::class, 'parent_id', 'id');
    }

    public function related_employees()
    {
        return $this->hasMany(ViewRelatedEmployee::class, 'task_id', 'id')
            ->where('language_code', auth()->user()->language_code);
    }

    public function folder()
    {
        return $this->hasOne(Folder::class, 'id', 'folder_id');
    }

    public function owner()
    {
        return $this->hasOne(ViewRelatedEmployee::class, 'task_id', 'id')
            ->where('language_code', auth()->user()->language_code)
            ->where('relation_type_id', 1);
    }

    public function executors()
    {
        return $this->hasMany(ViewRelatedEmployee::class, 'task_id', 'id')
            ->where('language_code', auth()->user()->language_code)
            ->where('relation_type_id', 2);
    }

    public function auditors()
    {
        return $this->hasMany(ViewRelatedEmployee::class, 'task_id', 'id')
            ->where('language_code', auth()->user()->language_code)
            ->where('relation_type_id', 3);
    }

    public function watchers()
    {
        return $this->hasMany(ViewRelatedEmployee::class, 'task_id', 'id')
            ->where('language_code', auth()->user()->language_code)
            ->where('relation_type_id', 4);
    }

    public function file()
    {
        return $this->hasMany(File::class, 'object_id', 'id')->where('object_type', 'task_file');
    }

    public function employee()
    {
        return $this->hasMany(RelatedEmployee::class, 'task_id', 'id');
    }
}
