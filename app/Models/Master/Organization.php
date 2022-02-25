<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\SoftDeletes;

class Organization extends Master
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'db_name',
        'host_name',
        'status',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function languages()
    {
        return $this->hasMany(OrganizationLanguage::class, 'organization_id', 'id');
    }
}
