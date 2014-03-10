<?php

require_once('config.php');
// require_once('connection.php');
require_once('class.db.php');

// require_once('models/comprador.php');
// require_once('controllers/comprador.controller.php');

// require_once('models/partida.php');
// require_once('controllers/partida.controller.php');

// require_once('models/ingresso.php');
// require_once('controllers/ingresso.controller.php');

// require_once('models/local.php');
// require_once('controllers/local.controller.php');

$db = new db("pgsql:dbname=ufpbdb;host=localhost;","postgres","postgres");


// $ctrl = new CompradorController($db);
// $ctr2 = new PartidaController($db);
// $ctr3 = new LocalController($db);

// $ingCtrl = new IngressoController($db);

include("views/home.php");

?>
