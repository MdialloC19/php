<?php
namespace public;

use Router\Router;



require_once(__DIR__.'/vendor/autoload.php');

define('BASE_VIEW_PATH','Views'.DIRECTORY_SEPARATOR);
$router=new Router();


$router->register('/',['Controllers\HomeController','index']);
 

// $router->register('/contact', function(){
//     return 'Contact Page';
// });

// $router->register('/about', function(){
//     return 'About us';
// });
// echo '<pre>';
// var_dump(explode('?',$_SERVER['REQUEST_URI']));
// echo '</pre>';
try {
    echo $router->resolve($_SERVER['REQUEST_URI']);
    //code...
} catch (\Throwable $th) {
    echo $th->getMessage()." à la ligne ".$th->getLine(); 
}
