<?php 

namespace Class;

use Class\Enums\OfficeStatus;
// require "../vendor/autoload.php";

class OfficeReservation{   

    public OfficeStatus $status;

    public function __construct()
    {
        $this->status= OfficeStatus::APPROVAL_PENDING;
    }
}