<?php

require_once 'Autoloader.php';

use Exo\Autoloader;
use Exo\User;
use Exo\Exchange;
use Exo\Product;

Autoloader::register();

$receiver = new User('toto@tutu.fr', 'toto', 'tutu', 19);
$owner = new User('titi@tata.fr', 'titi', 'tata', 19);
$product = new Product('saucisson', 'available', $owner);
$startDate = '12/11/2017';
$endDate = '15/11/2017';

$exchange = new Exchange();

//$save = $exchange->save($receiver, $product, $owner, $startDate, $endDate);

$dates = $exchange->areValidDates($startDate, $endDate);

//var_dump($save);
var_dump($dates);

//$start = DateTime::createFromFormat('m/d/Y', $startDate);
