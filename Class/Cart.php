<?php

class Cart{

    public int $_quantite;
    public float $_totalPrice;

    public function __construct(int $_quantite, float $_totPrice){

        $this->_quantite=$_quantite;
        $this->_totalPrice=$_totPrice;
    }

    public function getTotalPrice(): float
    {
        return $this->_totalPrice;
    }

    public function setTotalPrice(float $_price):void
    {
        $this->_totalPrice=$_price;
    }

    public function getQuantite(): int
    {
        return $this->_quantite;
    }

    public function setQuantite(float $_quant):void
    {
        $this->_quantite=$_quant;
    }

    public function setDiscount(float $_disc): void
    {
        $_newPrice=$this->_totalPrice-($this->_totalPrice*$_disc)/100;
        $this->setTotalPrice($_newPrice);
    }
}