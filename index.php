<?php

session_start();

require __DIR__ . '/vendor/autoload.php';


$cart = new Vladk23cm\Cart\Cart('cart', new Vladk23cm\Cart\Storage\SessionStore);

$cart->restore();

$cart->add('123', 1);
$cart->add('123', 1);

$cart->add('1243', 1);
$cart->add('1243', 1);

$cart->update();

print_r($_SESSION);