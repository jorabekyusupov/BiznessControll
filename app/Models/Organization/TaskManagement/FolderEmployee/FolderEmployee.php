<?php

namespace App\Models\Organization\TaskManagement\FolderEmployee;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\TaskManagement\FolderEmployeeFactory;

class FolderEmployee extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = FolderEmployeeFactory::class;
    
    protected $table = 'tm_folder_employees';

    public $timestamps = false;

    protected $fillable = [
        'folder_id',
        'employee_id',
    ];
}
