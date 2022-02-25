<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\SoftDeletes;

class Nationality extends Master
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'created_by',
        'updated_by',
        'deleted_by'
    ];
}
