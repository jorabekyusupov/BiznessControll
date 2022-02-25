<?php

namespace App\Models\Organization\HumanResources\Employee;

use App\Models\Master\Language;
use App\Models\Organization\Organization;

class EmployeeTranslation extends Organization
{
    public $timestamps = false;
    protected $fillable = [
        'object_id',
        'language_code',
        'first_name',
        'last_name',
        'middle_name'
    ];

    public function language()
    {
        return $this->hasOne(Language::class, 'code', 'language_code');
    }
}
