<?php

namespace Class\Exceptions;

use Exception;

class RouteNotFoundException extends Exception{

    protected $message="Cette route n'est pas trouvé";
}