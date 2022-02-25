<?php

namespace App\Repositories\Organization\Basic\ExtraColumn;

use App\Models\Organization\Basic\ExtraColumn\ExtraColumn;
use App\Models\Organization\Basic\ExtraColumn\ExtraColumnTranslation;
use App\Models\Organization\Basic\ExtraColumn\ViewExtraColumn;
use App\Repositories\Repository;

class ExtraColumnRepository extends Repository{

    public function __construct(ExtraColumn $extraColumn,ViewExtraColumn $viewExtraColumn, ExtraColumnTranslation $extraColumnTranslation)
    {
        $this->model = $extraColumn;
        $this->modelView = $viewExtraColumn;
        $this->modelTranslation = $extraColumnTranslation;
    }
}
