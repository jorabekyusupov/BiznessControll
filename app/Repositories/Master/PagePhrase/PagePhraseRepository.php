<?php

namespace App\Repositories\Master\PagePhrase;

use App\Models\Master\PagePhrase;
use App\Repositories\Repository;

class PagePhraseRepository extends Repository
{
    public function __construct(PagePhrase $pagePhrase)
    {
        $this->model = $pagePhrase;
    }
}
