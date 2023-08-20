<?php

use Class\ChildClass;
use Class\CoffeeMachine;
use Class\PremiumCoffeeMachine;
use Class\Enums\OfficeStatus;
use Class\ExpressoMachine;
use Class\IrishMachine;
use Class\MultiCoffee;
use Class\OfficeReservation;
use Class\ParentClass;

require_once(__DIR__.'/../vendor/autoload.php');
// $parent =new ParentClass();
// $child=new ChildClass();

// var_dump($parent->getName(),$child->getName());
$expresso=new ExpressoMachine();
$irish=new IrishMachine();
$multi=new MultiCoffee();

var_dump(
    $expresso->makeExpressoCoffee(),
    $irish->makeIrishCoffee(),
    $expresso->makeCoffee(),
    $irish->makeCoffee(),

    $multi->makeIrishCoffee(),
    $multi->makeCoffee(),
);

// var_dump(ChildClass::getName(),ParentClass::getName());