<?php

namespace App\Models\Organization\Basic\Phrase;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\Basic\PhraseFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phrase extends Organization
{
    use SoftDeletes, NewFactoryTrait;

    protected static string $model_factory = PhraseFactory::class;

    protected $fillable = [
        'word',
        'page_id',
        'created_by',
        'updated_by',
        'deleted_by',
        'updated_at'
    ];
    
    public function translations()
    {
        return $this->hasMany(PhraseTranslation::class,'object_id', 'id');
    }

    public function translation()
    {
        return $this->hasOne(PhraseTranslation::class, 'object_id', 'id')->where('language_code', auth()->user()->language_code);
    }
}
