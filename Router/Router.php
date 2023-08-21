<?php

namespace Router;

use Class\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes;

    public function register(string $path, callable|array $action): void 
    {
        $this->routes[$path]=$action;
    }

    public function resolve($url):mixed
    {
        // var_dump($url);
        $path=explode('?',$url)[0];
        $action=$this->routes[$path]??null;
        // var_dump($action);

        if(is_callable($action)){
            return $action();  
        }
        if(is_array($action))
        {
            
           [$className,$method]=$action;
           if(class_exists($className)&&method_exists($className,$method)){
            $class =new $className();
            return call_user_func_array([$class,$method],[]);
           } 
            
        }
        throw new RouteNotFoundException();
    }
}