<?php 

namespace Class\UserManagement;

use Class\Exceptions\UserNotVerifiedException;

class Login
{
    public function __construct(protected User $user)
    {
        
    }

    public function login ():bool
    {
        if(!$this->user->isVerified()){
            
            throw new UserNotVerifiedException();
        }
        return true;
    }
}