<?php 

namespace Class;

use Class\Enums\OfficeStatus;

class OfficeReservation{   


    private static ?self $_instance=null;
    private static int $count =0 ;
    private function __construct(public string $information)
    {
       self::$count++;
    }

    public static function getCount():int
    {
        return self::$count;
    }

    public static  function getInstance():self
    {
        if(is_null(self::$_instance)){
            self::$_instance=new OfficeReservation("Une nouvelle instance");
        }
        return self::$_instance;
    }
}