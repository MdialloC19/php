<?php

namespace Class;

class ParentClass{

    protected static string $name='ParentCLass';

    public static  function getName():string
    {
        // var_dump(get_class($this));
        return self::$name;
    }
}