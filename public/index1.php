<?php

use Class\Enums\OfficeStatus;
use Class\OfficeReservation;

require_once(__DIR__.'/../vendor/autoload.php');

OfficeReservation::getInstance();
OfficeReservation::getInstance();
OfficeReservation::getInstance();

var_dump(OfficeReservation::getCount());