<?php

namespace App\Models\Master;


class File extends Master
{
    protected $fillable = [
        'object_type',
        'object_id',
        'file_name',
        'physical_name',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
