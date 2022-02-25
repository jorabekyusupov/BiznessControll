<?php

namespace App\Models\Organization\Basic\ExtraColumn;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\Basic\ExtraColumnFactory;

class ExtraColumn extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = ExtraColumnFactory::class;
    protected $table = 'extra_columns';

    protected $fillable = [
        'type',
        'created_by',
        'updated_by',
        'updated_at'
    ];
    public function translations()
    {
        return $this->hasMany(ExtraColumnTranslation::class, 'object_id', 'id');
    }
    public function translation()
    {
        return $this->hasOne(ExtraColumnTranslation::class, 'object_id', 'id');
    }
}
