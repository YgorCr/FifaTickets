<?php

require_once('config.php');
// require_once('connection.php');
require_once('class.db.php');

require_once('models/comprador.php');
require_once('controllers/comprador.controller.php');

$db = new db("pgsql:dbname=ufpbdb;host=localhost;","postgres","postgres");

$ctrl = new CompradorController($db);

$cmp = new Comprador();

$comp1 = new Comprador("ygor2", 123, 1234, "PB", "João Pessoa", "dos milagres", "cristo", "do lado da minha vizinha", "YgorCr", "123Cr");

$comp1->set('id', '8');

$ctrl->update($comp1);

include("views/home.php");

?>
