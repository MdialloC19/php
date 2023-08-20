<?php

namespace Router;

use Class\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;

    public function register(string $path, callable $action): void 
    {
        $this->routes[$path]=$action;
    }

    public function resolve($url):mixed
    {
        $path=explode('?',$url)[0];
        $action=$this->routes[$path]??null;
        if(!is_callable($action)){
            throw new RouteNotFoundException();
        }
        return $action();
    }
}