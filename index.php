<?php

require_once('config.php');
// require_once('connection.php');
require_once('class.db.php');

require_once('models/comprador.php');
require_once('controllers/comprador.controller.php');

require_once('models/partida.php');
require_once('controllers/partida.controller.php');

$db = new db("pgsql:dbname=ufpbdb;host=localhost;","postgres","postgres");

$ctrl = new PartidaController($db);

$partida = new Partida();
$partida->set("id", 1);
$partida->set("nome", "partida1");
$partida->set("data", "1993/01/27");
$partida->set("tipo", 1);
$partida->set("local_id",8);

$ctrl->create($partida);

include("views/home.php");

?>
