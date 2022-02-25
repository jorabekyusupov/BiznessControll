<?php

namespace App\Services\Master\PagePhrase;

use App\Services\Service;
use App\Repositories\Master\PagePhrase\PagePhraseRepository;

class PagePhraseService extends Service
{
    public function __construct(PagePhraseRepository $pagePhraseRepository)
    {
        $this->repository = $pagePhraseRepository;
    }

    public function indexPagePhrase($data)
    {
        $page_id = $data['page_id'] ?? null;
        if ($page_id) return $this->get()->where('page_id', $page_id)->get();
        else return $this->getPaginate($data);

    }

}
