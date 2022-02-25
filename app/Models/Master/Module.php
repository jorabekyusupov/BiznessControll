<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\SoftDeletes;

class Module extends Master
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'icon_name',
        'module_link',
        'icon_type',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
