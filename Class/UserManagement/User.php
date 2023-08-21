<?php

namespace Class\UserManagement;

use Class\Traits\Mailable;


class User
{

    use Mailable;

    public function __construct(public string $username,public string $password)
    {
        
    }
    public function isVerified():bool
    {
        return false;
    }

    public function authentification():string
    {
        return 'authentification';
    }
}