<?php

namespace App\Models\Master;

class Picture extends Master
{
    protected $fillable = [
        'object_type',
        'object_id',
        'is_default',
        'picture_name',
        'physical_name',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
