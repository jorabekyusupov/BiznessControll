<?php

namespace Tests\Feature;

use App\Models\User;

class MasterBase extends Base
{
    protected $apiUrl;

    public function setUp() : void
    {
        parent::setUp();
        $this->apiUrl = 'master.' . $this->modelName;
    }

}
