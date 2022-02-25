<?php

namespace App\Observers\Organization\Basic;

use App\Http\Requests\Organization\Basic\Phrase\PhraseTranslationRequest;
use App\Models\Organization\Basic\Phrase\Phrase;
use App\Services\Organization\Basic\Phrase\PhraseService;

class PhraseObserver
{
    protected $phraseService, $phraseTranslationRequest;

    public function __construct(PhraseService $phraseService, PhraseTranslationRequest $phraseTranslationRequest)
    {
        $this->phraseService = $phraseService;
        $this->phraseTranslationRequest = $phraseTranslationRequest;
    }

    public function created(Phrase $phrase)
    {
        $data = $this->phraseTranslationRequest->validated();
        if (isset($data['translations'])) {
            return $this->phraseService->storeTranslation($phrase->id, $data['translations']);
        }
    }

    public function updated(Phrase $phrase)
    {
        $data = $this->phraseTranslationRequest->validated();
        if ($data) {
            return $this->phraseService->editTranslation($phrase->id, $data['translations']);
        }
    }

    public function deleted(Phrase $orgPhrase)
    {
        //
    }

    public function restored(Phrase $orgPhrase)
    {
        //
    }

    public function forceDeleted(Phrase $orgPhrase)
    {
        //
    }
}
