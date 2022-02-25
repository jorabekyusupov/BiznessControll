<?php

namespace App\Models\Organization\HumanResources\Staff;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\HumanResources\StaffFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staff extends Organization
{
    use SoftDeletes, NewFactoryTrait;

    protected static string $model_factory = StaffFactory::class;

    protected $table = 'hr_staff';

    protected $fillable = [
        'department_id',
        'position_id',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

}
