<?php

namespace App\Services\Organization\Basic\Phrase;

use App\Services\Service;
use App\Repositories\Organization\Basic\Phrase\PhraseRepository;
use App\Services\Master\Phrase\PhraseService as MasterPhraseService;

class PhraseService extends Service
{
    protected MasterPhraseService $masterPhraseService;

    public function __construct(
        PhraseRepository    $phraseRepository,
        MasterPhraseService $masterPhraseService
    )
    {
        $this->masterPhraseService = $masterPhraseService;
        $this->repository = $phraseRepository;
    }

    public function listPhrase($data)
    {
        return $this->getPaginate($data, ['translations']);
    }

    public function translate($data)
    {
        $language_code = $data['language_code'];
//        $translate_languages = $data['translate_languages'];
        $translate_languages = json_decode($data['translate_languages'], true);
        $page_id = $data['page_id'];

        return $this->masterPhraseService
            ->getView()
            ->with('translate', function ($query) use ($translate_languages, $page_id) {
                $query->with('translations', function ($subQuery) use ($translate_languages) {
                    $subQuery->whereIn('language_code', $translate_languages);
                });
            })
            ->where('language_code', $language_code)
            ->where('page_id', $page_id)
            ->get();
    }

}
