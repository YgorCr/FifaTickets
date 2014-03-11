<?php

require_once('config.php');
// require_once('connection.php');
require_once('class.db.php');

require_once('models/compra.php');
require_once('controllers/compra.controller.php');

require_once('models/comprador.php');
require_once('controllers/comprador.controller.php');

require_once('models/partida.php');
require_once('controllers/partida.controller.php');

require_once('models/ingresso.php');
require_once('controllers/ingresso.controller.php');

require_once('models/local.php');
require_once('controllers/local.controller.php');

require_once("models/ingressosClasses.php");
require_once("controllers/ingressosClasses.controller.php");

$db = new db("pgsql:dbname=ufpbdb5;host=localhost;","postgres","postgres");

include("views/home.php");

?>
