<?php

namespace App\Models\Organization\HumanResources\Position;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\HumanResources\PositionFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Position extends Organization
{
    use SoftDeletes, NewFactoryTrait;

    protected static string $model_factory = PositionFactory::class;
    
    protected $table = 'hr_positions';

    protected $fillable = [
        'position_type_id',
        'code',
        'created_by',
        'updated_by',
        'deleted_by',
        'updated_at'
    ];
    public function translations()
    {
        return $this->hasMany(PositionTranslation::class, 'object_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(PositionTranslation::class, 'object_id', 'id')->where('language_code', auth()->user()->language_code);
    }
}
