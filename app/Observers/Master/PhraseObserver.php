<?php

namespace App\Observers\Master;

use App\Http\Requests\Master\Phrase\PhraseTranslationRequest;
use App\Models\Master\Phrase\Phrase;
use App\Services\Master\Phrase\PhraseService;

class PhraseObserver
{
    protected PhraseService $phraseService;
    protected PhraseTranslationRequest $phraseTranslationRequest;

    public function __construct(PhraseService $phraseService,PhraseTranslationRequest $phraseTranslationRequest)
    {
        $this->phraseService = $phraseService;
        $this->phraseTranslationRequest = $phraseTranslationRequest;
    }

    /**
     * Handle the Phrase "created" event.
     *
     * @param  \App\Models\Master\Phrase\Phrase  $phrase
     * @return void
     */
    public function created(Phrase $phrase)
    {
        $data = $this->phraseTranslationRequest->validated();
        if ($data) $this->phraseService->storeTranslation($phrase->id, $data['translations']) ;
    }

    /**
     * Handle the Phrase "updated" event.
     *
     * @param  \App\Models\Master\Phrase\Phrase  $phrase
     * @return void
     */
    public function updated(Phrase $phrase)
    {
        $data = $this->phraseTranslationRequest->validated();
        if ($data) $this->phraseService->editTranslation($phrase->id, $data['translations']) ;
    }

    /**
     * Handle the Phrase "deleted" event.
     *
     * @param  \App\Models\Master\Phrase\Phrase  $phrase
     * @return void
     */
    public function deleted(Phrase $phrase)
    {
        //
    }

    /**
     * Handle the Phrase "restored" event.
     *
     * @param  \App\Models\Master\Phrase\Phrase  $phrase
     * @return void
     */
    public function restored(Phrase $phrase)
    {
        //
    }

    /**
     * Handle the Phrase "force deleted" event.
     *
     * @param  \App\Models\Master\Phrase\Phrase  $phrase
     * @return void
     */
    public function forceDeleted(Phrase $phrase)
    {
        //
    }
}
