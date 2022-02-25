<?php

namespace App\Services\Master\Language;

use App\Services\Service;
use App\Repositories\Master\Language\LanguageRepository;

class LanguageService extends Service
{
    public function __construct(LanguageRepository $languageRepository)
    {
        $this->repository = $languageRepository;
    }

}
