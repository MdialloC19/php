<?php 

namespace Controllers;

use Models\User;
use Source\Renderer;

class HomeController
{
    public function index():Renderer
    {

        $userModel=new User();
        $users=$userModel->all();
        // $statement=$userModel->getPDO()->query('SELECT *FROM users');

        // foreach( $statement->fetchAll() as $user){
        //     var_dump($user);
        // }
        
        return Renderer::make('home/index', compact('users'));
    }

}