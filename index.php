<?php

require_once('./Class/Cart.php');

$_cart=new Cart(10,100);

$_cart->setDiscount(5);
var_dump($_cart);