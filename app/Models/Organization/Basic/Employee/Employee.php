<?php

namespace App\Models\Organization\Basic\Employee;

use App\Models\Master\Picture;
use App\Models\Master\UserOrganization;
use App\Models\User;
use App\Models\Organization\Organization;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Organization\HumanResources\EmployeeStaff\EmployeeStaff;
use App\Models\Organization\TaskManagement\RelatedEmployee\RelatedEmployee;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\Basic\EmployeeFactory;

class Employee extends Organization
{
    use SoftDeletes, NewFactoryTrait;

    protected static string $model_factory = EmployeeFactory::class;

    protected $fillable = [
        'user_id',
        'nationality_id',
        'born_date',
        'gender',
        'first_work_date',
        'leave_date',
        'contract_number',
        'contract_date',
        'phone',
        'telegram',
        'avatar',
        'email',
        'note',
        'responsible_id',
        'is_active',
        'is_accessible',
        'inn',
        'inps',
        'created_by',
        'updated_by',
        'deleted_by',
        'updated_at'
    ];

    public function avatar()
    {
        return $this->hasOne(Picture::class, 'object_id', 'user_id')
            ->where('object_id', 1)
            ->where('is_default', 1);
    }

    public function translations()
    {
        return $this->hasMany(EmployeeTranslation::class, 'object_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(EmployeeTranslation::class, 'object_id', 'id')->where('language_code', auth()->user()->language_code);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function employee_staff()
    {
        return $this->hasMany(EmployeeStaff::class, 'employee_id', 'id');
    }

    public function tasks()
    {
        return $this->hasMany(RelatedEmployee::class, 'employee_id', 'id');
    }

    public function user_organizations()
    {
        return $this->hasMany(UserOrganization::class, 'user_id', 'user_id');
    }
}
