<?php

namespace App\Repositories\Master\Language;

use App\Models\Master\Language;
use App\Repositories\Repository;

class LanguageRepository extends Repository
{
    public function __construct(Language $language)
    {
        $this->model = $language;
    }

}
