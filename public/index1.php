<?php

use Class\CoffeeMachine;
use Class\PremiumCoffeeMachine;
use Class\Enums\OfficeStatus;
use Class\OfficeReservation;

require_once(__DIR__.'/../vendor/autoload.php');
 $coffe=new CoffeeMachine(4);
 $premiumcoffe=new PremiumCoffeeMachine(2);

 $premiumcoffe->select("vanilla");