<?php

namespace Router;

use Class\Exceptions\RouteNotFoundException;

class Router
{
    private array $routes=[];

    public function register(string $path, callable|array $action, string $HTTPVerb ): void 
    {
        $this->routes[$HTTPVerb][$path]=$action;
    }

    public function get(string $path, callable|array $action)
    {
        $this->register($path,$action,'GET');
    }
    public function post(string $path, callable|array $action)
    {
        $this->register($path,$action,'POST');
    }

    public function getRoutes():array
    {
        return $this->routes;
    }
    public function resolve($url, string $requestMethod):mixed
    {
        // var_dump($url);
        $path=explode('?',$url)[0];
        $action=$this->routes[$requestMethod][$path]??null;
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