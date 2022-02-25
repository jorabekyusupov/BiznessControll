<?php

namespace App\Models\Organization\Basic\Employee;

use App\Models\Master\Language;
use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\Basic\EmployeeTranslationFactory;

class EmployeeTranslation extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = EmployeeTranslationFactory::class;

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
