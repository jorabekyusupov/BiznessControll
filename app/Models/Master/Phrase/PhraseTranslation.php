<?php

namespace App\Models\Master\Phrase;

use App\Models\Master\Master;

class PhraseTranslation extends Master
{
    public $timestamps = false;

    protected $fillable = [
        'object_id',
        'translation',
        'language_code'
    ];
}
