<?php

// require_once('./Class/Paypal/Payment.php');
// require_once('./Class/Stripe/Payment.php');
// require_once('./Class/Users/User.php');

// spl_autoload_register(function($class){
//     $path = dirname(__DIR__) . '/' . str_replace('\\', '/', $class) . '.php';
//     if(file_exists($path)){
//         require_once($path);
//     }
// });

require "../vendor/autoload.php";
use \Class\Paypal\Payment as PaypalPayment;
use \Class\Stripe\Payment as StripePayment;
use \Colors\RandomColor;

var_dump(RandomColor::one()); 


$_paymentPaypal=new PaypalPayment();
$_paymentStripe=new StripePayment();
var_dump($_paymentStripe, $_paymentPaypal);
