<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\SoftDeletes;

class Language extends Master
{
    use SoftDeletes;

    protected $fillable = [
        'code',
        'name',
        'is_active',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
