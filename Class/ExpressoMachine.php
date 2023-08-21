<?php 

namespace Class;

use Class\Traits\ExpressoCoffeeTrait;

class ExpressoMachine extends  CoffeeMaker
{
    use ExpressoCoffeeTrait;
    public function makeExpressoCoffee():string
    {
        return static::class.' fait un expresso qui est bon (fait du expresso)';
    } 

}