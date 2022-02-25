<?php

namespace App\Services\Master\Phrase;

use App\Repositories\Master\Phrase\PhraseRepository;
use App\Services\Service;

class PhraseService extends Service
{
    public function __construct(PhraseRepository $phraseRepository)
    {
        $this->repository = $phraseRepository;
    }

    public function globalPhrases($data)
    {
        $model = $this->getView()->whereNull('page_id')->where('language_code', $data['language_code']);
        return $this->paginate($model, $data);
    }


}
