<?php

namespace Class\Traits;


trait ExpressoCoffeeTrait
{

    public function makeExpressoCoffee():string
    {
        return static::class.' fait un expresso qui est bon';
    }
    
}