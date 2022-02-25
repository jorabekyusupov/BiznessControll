<?php

namespace App\Models\Master;

class UserOrganization extends Master
{
    protected $fillable = [
        'user_id',
        'organization_id'
    ];
}
