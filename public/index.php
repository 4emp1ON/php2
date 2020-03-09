<?php

use App\services\DB;
use App\models\Good;
use App\services\Autoload;

include dirname(__DIR__) . "/services/Autoload.php";
spl_autoload_register([new Autoload(), 'loadClass']);

//var_dump((new Good())->getOne($_GET['id']));
//var_dump((new Good())->getAllObjects());

$good = new Good();

//$good->setId(2);
$good->setPrice(120);
$good->setName('Test');
$good->setInfo('Наш товар, ваш купец');

$good->save();

var_dump($good);
