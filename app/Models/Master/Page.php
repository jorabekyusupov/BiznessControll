<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\SoftDeletes;

class Page extends Master
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'module_id',
        'page_link',
        'page_icon',
        'icon_type',
        'created_by',
        'updated_by',
        'deleted_by'
    ];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
