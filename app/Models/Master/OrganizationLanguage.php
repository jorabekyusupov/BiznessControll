<?php

namespace App\Models\Master;

class OrganizationLanguage extends Master
{
    protected $fillable = [
        'language_id',
        'organization_id',
        'is_default'
    ];

    public function languages()
    {
        return $this->hasMany(Language::class, 'id', 'language_id');
    }


}
