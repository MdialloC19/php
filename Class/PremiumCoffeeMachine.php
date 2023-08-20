<?php
namespace Class;

class PremiumCoffeeMachine extends CoffeeMachine
{
   
    public function __construct( int $cups)
    {
        parent::__construct($cups);
    }
    public function select (string $selection){
        $result =match($selection){
            'expresso'=>$this->makeExpresso(),
            'vanilla'=>$this->makeVanilla(),
            default => 'erreur'
        };

        return $result;
    }

    public function makeVanilla(){
        for($i=0;$i<$this->cups;$i++){
            
            echo 'café Vanilla n°'.$i+1 .'servi !  ';
        }
    }
}