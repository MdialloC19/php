<?php

namespace Class\UseManagement;

use Class\Traits\Mailable;


class User{

    use Mailable;

    public function download():string
    {
        return 'Download';
    }
}