<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

?>

<?php

	require_once("models/comprador.php");
	require_once("controllers/comprador.controller.php");

	$ctr = new CompradorController($db);

	$compradores = $ctr->all();	

	foreach ($compradores as $comprador) {

?>

	Nome: <?php echo $comprador->get("nome");  ?><br>


<?php

	}

	// arquivo comum para o final das páginas
	include("footer.php");

?>