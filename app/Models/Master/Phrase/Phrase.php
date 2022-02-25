<?php

namespace App\Models\Master\Phrase;

use App\Models\Master\Master;
use Illuminate\Database\Eloquent\SoftDeletes;

class Phrase extends Master
{
    use SoftDeletes;

    protected $table = 'phrases';

    protected $fillable = [
        'page_id',
        'word',
        'created_by',
        'updated_by',
        'deleted_by',
        'updated_at'
    ];

    public function translations()
    {
        return $this->hasMany(PhraseTranslation::class, 'object_id', 'id');
    }
    public function translation()
    {
        return $this->hasOne(PhraseTranslation::class,'object_id','id');
    }
}
