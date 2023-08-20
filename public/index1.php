<?php

use Class\Enums\OfficeStatus;
use Class\OfficeReservation;

require_once(__DIR__.'/../vendor/autoload.php');

// $status="en attente";

// if($status===Reservation::APPROVAL_PENDING){
//     echo "En atente !!!";
// }
$reservation =new OfficeReservation();
if(OfficeStatus::APPROVAL_PENDING===$reservation->status)
    echo 'En attente';