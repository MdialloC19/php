<?php
namespace Class;

class CoffeeMachine{
    
    protected int $cups;

    public function __construct(int $cups){
        $this->cups=$cups;
    }
    
    public function select (string $selection){
        $result =match($selection){
            'expresso'=>$this->makeExpresso(),
            default => 'erreur'
        };

        return $result;
    }

    public function makeExpresso(){
        for($i=0;$i<$this->cups;$i++){

            echo 'café Expresso n°'.$i+1 .'servi !\n';
        }
    }
}