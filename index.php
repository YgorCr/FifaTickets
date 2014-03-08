<?php

require_once('config.php');
require_once('connection.php');

require_once('controllers/comprador.controller.php');

$db = new FDB();

$comprador_ctrl = new CompradorController($db);

$list = $comprador_ctrl->all();

for($i=0;$i<count($list);$i++)
{
	$comprador = $list[$i];
	echo $comprador->get('nome').'<br>';
}

?>
