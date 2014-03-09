<?php

require_once('config.php');
// require_once('connection.php');
require_once('class.db.php');

require_once('models/comprador.php');
require_once('controllers/comprador.controller.php');

require_once('models/partida.php');
require_once('controllers/partida.controller.php');

$db = new db("pgsql:dbname=ufpbdb;host=localhost;","postgres","postgres");

$ctrl = new CompradorController($db);


include("views/home.php");

?>
