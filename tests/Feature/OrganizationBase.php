<?php

namespace Tests\Feature;

class OrganizationBase extends Base
{
    public function setUp() : void
    {
        parent::setUp();
        $moduleShort = '';
        if(!empty($this->moduleShort)){
            $moduleShort = '.' . $this->moduleShort;
        }
        $this->apiUrl = 'organization' . $moduleShort . '.' . $this->modelName;

    }
}
