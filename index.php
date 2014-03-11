<?php

include('config.php');

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

$configUrl = "pgsql:dbname=".$config["dbname"].";host=".$config["dbhost"].";";

$db = new db($configUrl,$config["dbuser"],$config["dbpass"]);

$ac = $_GET["a"];

if(!isset($ac) || $ac=="")
{
	$ac = "home";
}

if(file_exists("views/$ac.view.php"))
{
	include("views/$ac.view.php");
} else {
	include("views/404.php");
}

?>
