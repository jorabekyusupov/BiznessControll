<?php

namespace App\Repositories\Master\Phrase;

use App\Models\Master\Phrase\Phrase;
use App\Models\Master\Phrase\PhraseTranslation;
use App\Models\Master\Phrase\ViewPhrase;
use App\Repositories\Repository;

class PhraseRepository extends Repository
{
    public function __construct(Phrase $phrase, PhraseTranslation $phraseTranslation, ViewPhrase $viewPhrases)
    {
        $this->model = $phrase;
        $this->modelTranslation = $phraseTranslation;
        $this->modelView = $viewPhrases;
    }

}
