<?php

namespace App\Models\Organization\Basic\EmployeeSetting;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\Basic\EmployeeSettingFactory;

class EmployeeSetting extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = EmployeeSettingFactory::class;
    
    protected $table = 'employee_settings';

    protected $fillable = [
        'employee_id',
        'default_organization',
        'default_language'
    ];
}
