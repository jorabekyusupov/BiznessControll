<?php

namespace App\Models\Organization\Basic\ExtraColumn;

use App\Models\Organization\Organization;

class ExtraColumnTranslation extends Organization
{
    protected $table = 'extra_column_translations';


    public $timestamps = false;

    protected $fillable = [
        'object_id',
        'language_code',
        'name'
    ];
}
