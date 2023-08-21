<?php 
namespace Class;

use Class\Traits\ExpressoCoffeeTrait;
use Class\Traits\IrishCoffeeTrait;

// use Class\CoffeeMake;

class MultiCoffee extends CoffeeMaker 
{
    use IrishCoffeeTrait;
    use ExpressoCoffeeTrait;
}