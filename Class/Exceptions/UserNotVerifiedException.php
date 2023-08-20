<?php 

namespace Class\Exceptions;

use Exception;

class UserNotVerifiedException extends Exception
{
    protected $message="Utiliseur non vérifié";

}