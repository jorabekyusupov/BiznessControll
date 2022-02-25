<?php

namespace App\Repositories\Organization\Basic\Phrase;

use App\Models\Organization\Basic\Phrase\Phrase;
use App\Models\Organization\Basic\Phrase\PhraseTranslation;
use App\Models\Organization\Basic\Phrase\ViewPhrase;
use App\Repositories\Repository;

class PhraseRepository extends Repository
{
    public function __construct(Phrase $phrase, PhraseTranslation $phraseTranslation, ViewPhrase $viewPhrase)
    {
        $this->model = $phrase;
        $this->modelTranslation = $phraseTranslation;
        $this->modelView = $viewPhrase;
    }

}
