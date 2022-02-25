<?php

namespace App\Models\Organization\HumanResources\Position;

use App\Models\Organization\Organization;
use Illuminate\Database\Eloquent\SoftDeletes;

class ViewPosition extends Organization
{
    use SoftDeletes;

    protected $table = 'view_hr_positions';

}
