<?php

namespace Class;

use Class\Traits\Mailable;


class User{

    use Mailable;

    public function download():string
    {
        return 'Download';
    }
}