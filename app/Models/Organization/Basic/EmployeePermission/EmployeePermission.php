<?php

namespace App\Models\Organization\Basic\EmployeePermission;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\Basic\EmployeePermissionFactory;

class EmployeePermission extends Organization
{    
    use NewFactoryTrait;

    protected static string $model_factory = EmployeePermissionFactory::class;
    
    protected $table = 'employee_permissions';

    protected $fillable = [
        'employee_id',
        'permission_id',
        'created_by',
        'updated_by'
    ];
}
