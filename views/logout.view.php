<?php

	// arquivo comum para o cabeçalho das páginas
	include("header.php");

	session_start();

	$ingressosClassesCtr = new IngressosClassesController($db);

	$classes = $_SESSION["compra_classes"];
	foreach ($classes as $classe_id) {
		$classe = $ingressosClassesCtr->byId($classe_id);

		$vendidos = $classe->get("vendidos");
		$vendidos = $vendidos-1;
		$classe->set("vendidos", $vendidos);
		$ingressosClassesCtr->update($classe);
	}

	unset($_SESSION["comprador_id"]);
	unset($_SESSION["admin_id"]);
	unset($_SESSION["compra_classes"]);

?>

<?php

	// arquivo comum para o final das páginas
	include("footer.php");

?>
