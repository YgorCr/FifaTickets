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

require_once("models/administrador.php");
require_once("controllers/administrador.controller.php");

$configUrl = "pgsql:dbname=".$config["dbname"].";host=".$config["dbhost"].";";

$db = new db($configUrl,$config["dbuser"],$config["dbpass"]);

$compradorController = new CompradorController($db);

// $_SESSION["comprador_id"] = "2"; // TODO: FAZER O LOGIN!
session_start();
$comprador_id = $_SESSION["comprador_id"];
if(isset($comprador_id))
{
	$comprador = $compradorController->byId($comprador_id);
}

$admin_id = $_SESSION["admin_id"];
if(isset($admin_id))
{
	$adminController = new AdministradorController($db);
	$admin = $adminController->byId($admin_id);
}

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
