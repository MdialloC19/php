<?php

require_once('./Class/Paypal/Payment.php');
require_once('./Class/Stripe/Payment.php');
require_once('./Class/Users/User.php');

use \Class\Paypal\Payment as PaypalPayment;
use \Class\Stripe\Payment as StripePayment;

$_paymentPaypal=new PaypalPayment();

$_paymentStripe=new StripePayment();

var_dump($_paymentStripe, $_paymentPaypal);