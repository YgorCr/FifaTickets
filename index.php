<?php

require_once('config.php');
// require_once('connection.php');
require_once('class.db.php');

require_once('models/comprador.php');
require_once('controllers/comprador.controller.php');

require_once('models/partida.php');
require_once('controllers/partida.controller.php');

$db = new db("pgsql:dbname=ufpbdb;host=localhost;","postgres","postgres");

<<<<<<< HEAD
$ctrl = new CompradorController($db);
$ctr2 = new PartidaController($db);
$ctr3 = new LocalController($db);
=======
$ctrl = new PartidaController($db);
>>>>>>> cfb359bda8e7cffb926e18adf0290b31fb249139


include("views/home.php");

?>
