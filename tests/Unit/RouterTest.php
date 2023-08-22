<?php

namespace Tests\Unit;

use Router\Router;
use PHPUnit\Framework\TestCase;


class RouterTest extends TestCase
{
    /** @test */
    public function it_registers_get_routes():void
    {
        $router=new Router();
        $router->get('/',['Controllers\HomeController','index']);
        // $router->getRoutes();
        $this->assertEquals(
            ['GET'=>['/'=>['Controllers\HomeController', 'index']]],
            $router->getRoutes()
        );
    }

     /** @test */
     public function it_registers_post_routes():void
     {
         $router=new Router();
         $router->post('/contact',['Controllers\Contact','store']);
         // $router->getRoutes();
         $this->assertEquals(
             ['POST'=>
                    ['/contact'=>['Controllers\Contact', 'store']]
            ],
            $router->getRoutes()
         );
     }
    /** @test */

    public function it_doesnt_have_any_routes_before_registering_routes():void
    {
        $router=new Router();
       
        $this->assertEmpty($router->getRoutes());
    }
}