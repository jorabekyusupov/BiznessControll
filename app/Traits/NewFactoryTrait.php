<?php

namespace App\Traits;

trait NewFactoryTrait
{
    protected static function newFactory()
    {
        return self::$model_factory::new();
    }
}
