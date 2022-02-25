<?php

namespace App\Models\Organization\HumanResources\Position;

use App\Models\Organization\Organization;

class PositionTranslation extends Organization
{
    protected $table = 'hr_position_translations';

    public $timestamps = false;

    protected $fillable = [
        'object_id',
        'language_code',
        'name'
    ];
}
