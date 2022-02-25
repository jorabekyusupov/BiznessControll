<?php

namespace App\Models\Master;

class OrganizationModule extends Master
{
    protected $fillable = [
        'organization_id',
        'module_id',
        'status',
        'created_by',
        'updated_by'
    ];
}
