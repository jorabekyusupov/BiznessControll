<?php

namespace App\Models\Organization\Basic\Phrase;

use App\Models\Organization\Organization;
use App\Traits\NewFactoryTrait;
use Database\Factories\Organization\Basic\PhraseTranslationFactory;

class PhraseTranslation extends Organization
{
    use NewFactoryTrait;

    protected static string $model_factory = PhraseTranslationFactory::class;
    public $timestamps = false;

    protected $fillable = [
        'object_id',
        'phrase_id',
        'language_code',
        'translation'
    ];
}
